<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class BookingController extends Controller
{
    public function create(Request $request, ?Product $product = null)
    {
        // kalau dari product (direct booking)
        if ($product) {
            $cart = [
                $product->id => [
                    'name' => $product->name,
                    'price' => $product->price_per_day,
                    'quantity' => $request->quantity ?? 1,
                    'image' => $product->image,
                ],
            ];
        } else {
            // dari cart
            $cart = session()->get('cart', []);
        }

        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('error', 'Keranjang kosong!');
        }

        return view('booking.create', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',

            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',

            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $days = $start->diffInDays($end) + 1;

        $total = 0;

        //  buat booking dulu (tanpa total)
        $booking = Booking::create([
            'booking_code' => 'BOOK-'.strtoupper(Str::random(6)),
            'user_id' => Auth::id(),
            'start_date' => $start,
            'end_date' => $end,

            'total_price' => 0, // nanti diupdate

            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,

            'note' => $request->note,
            'status' => 'pending',
        ]);

        //  loop semua produk
        foreach ($request->products as $item) {

            $product = Product::findOrFail($item['product_id']);

            if ($product->stock < $item['quantity']) {
                abort(400, 'Stok '.$product->name.' tidak cukup');
            }

            $subtotal = $days * $product->price_per_day * $item['quantity'];

            // simpan ke booking_items
            BookingItem::create([
                'booking_id' => $booking->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price_per_day,
                'subtotal' => $subtotal,
            ]);

            // kurangi stok
            $product->decrement('stock', $item['quantity']);

            // total semua
            $total += $subtotal;
        }

        //  update total booking
        $booking->update([
            'total_price' => $total,
        ]);

        //  MIDTRANS CONFIG
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // PARAMETER
        $params = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->customer_name,
                'email' => $booking->customer_email,
                'phone' => $booking->phone,
            ],
        ];

        //  SNAP TOKEN
        $snapToken = Snap::getSnapToken($params);

        return redirect()
            ->route('booking.create')
            ->with('snap_token', $snapToken)
            ->with('booking_id', $booking->id);
    }

    public function success(Booking $booking)
    {
        $booking->load('items.product');

        return view('booking.success', compact('booking'));
    }

    public function addToCart(Product $product)
    {
        // Cek kalau stok kosong
        if ($product->stock <= 0) {
            return back()->with('error', 'Stok produk sedang habis.');
        }

        // Ambil cart dari session
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {

            // Cegah quantity di cart melebihi stok asli produk
            if ($cart[$product->id]['quantity'] >= $product->stock) {
                return back()->with('error', 'Jumlah produk di keranjang sudah mencapai batas stok.');
            }

            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price_per_day,
                'quantity' => 1,
                'image' => $product->image,

                // Tambahkan ini agar CartController increase bisa cek stok juga
                'stock' => $product->stock,
            ];
        }

        // Simpan ke session
        session()->put('cart', $cart);

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function cart()
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk dihapus dari keranjang');
    }

    // CALLBACK MIDTRANS
    public function callback(Request $request)
    {
        // ambil data langsung dari Midtrans
        $data = $request->all();

        // debug dulu
        file_put_contents(storage_path('logs/midtrans.log'), json_encode($data).PHP_EOL, FILE_APPEND);

        $booking = Booking::where('booking_code', $data['order_id'])->first();

        if (! $booking) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $status = $data['transaction_status'];

        if (in_array($status, ['capture', 'settlement'])) {
            $booking->update([
                'status' => 'aktif',
            ]);
        } elseif ($status == 'pending') {
            $booking->update([
                'status' => 'pending',
            ]);
        } elseif (in_array($status, ['expire', 'cancel'])) {
            $booking->update([
                'status' => 'dibatalkan',
            ]);
        }

        return response()->json(['message' => 'OK'], 200);
    }
}
