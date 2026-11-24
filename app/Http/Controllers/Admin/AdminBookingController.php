<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = $this->filteredBookings($request)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.bookings.index', compact('bookings'));

    }

    public function export(Request $request): StreamedResponse
    {
        $bookings = $this->filteredBookings($request)
            ->latest()
            ->get();

        $filename = 'laporan-booking-'.now()->format('Y-m-d_H-i-s').'.csv';

        return response()->streamDownload(function () use ($bookings) {
            $output = fopen('php://output', 'w');

            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, [
                'Kode Booking',
                'Nama Pelanggan',
                'Email',
                'Telepon',
                'Produk',
                'Tanggal Mulai',
                'Tanggal Selesai',
                'Status',
                'Total Sewa',
                'Terlambat (Hari)',
                'Denda',
                'Total Akhir',
            ], ';');

            foreach ($bookings as $booking) {
                $products = $booking->items
                    ->map(function ($item) {
                        $name = $item->product?->name ?? 'Produk tidak ditemukan';

                        return $name.' x'.$item->quantity;
                    })
                    ->implode(', ');

                fputcsv($output, [
                    $this->csvValue($booking->booking_code),
                    $this->csvValue($booking->customer_name),
                    $this->csvValue($booking->customer_email),
                    $this->csvValue($booking->phone),
                    $this->csvValue($products),
                    $booking->start_date->format('d-m-Y'),
                    $booking->end_date->format('d-m-Y'),
                    ucfirst($booking->status),
                    $booking->total_price,
                    $booking->late_days,
                    $booking->penalty,
                    $booking->total_price + $booking->penalty,
                ], ';');
            }

            fclose($output);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,aktif,selesai,dibatalkan',
        ]);

        // pending → aktif
        if ($booking->status === 'pending' && $request->status === 'aktif') {

            $booking->update(['status' => 'aktif']);

        }

        // pending → dibatalkan
        elseif ($booking->status === 'pending' && $request->status === 'dibatalkan') {

            $booking->update(['status' => 'dibatalkan']);

        }

        //  aktif → selesai (DI SINI HITUNG DENDA)
        elseif ($booking->status === 'aktif' && $request->status === 'selesai') {

            $today = Carbon::now();
            $endDate = Carbon::parse($booking->end_date);

            $lateDays = 0;
            $penalty = 0;

            if ($today->gt($endDate)) {
                $lateDays = $endDate->diffInDays($today);
                $penalty = $booking->total_price * 0.15 * $lateDays;
            }

            $booking->update([
                'status' => 'selesai',
                'late_days' => $lateDays,
                'penalty' => $penalty,
            ]);

        } else {
            return redirect()->back()->with('error', 'Perubahan status tidak valid!');
        }

        return redirect()->back()->with('success', 'Status booking berhasil diupdate!');
    }

    private function filteredBookings(Request $request): Builder
    {
        $query = Booking::with('items.product');

        // ini fitur cari booking di halaman admin lek
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('customer_name', 'like', '%'.$request->search.'%')
                    ->orWhere('booking_code', 'like', '%'.$request->search.'%');
            });
        }

        // ini untuk Filter status bookingan
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // ini Filter tanggal di halaman booking admin
        if ($request->date) {
            $query->whereDate('start_date', $request->date);
        }

        return $query;
    }

    private function csvValue(?string $value): string
    {
        if ($value !== null && preg_match('/^[=+\-@\t\r]/', $value)) {
            return "'".$value;
        }

        return $value ?? '';
    }
}
