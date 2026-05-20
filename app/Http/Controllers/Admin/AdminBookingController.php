<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
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

        $bookings = $query->latest()->paginate(10)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));

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
}
