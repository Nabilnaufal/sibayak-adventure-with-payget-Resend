<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $product = Product::all();
        $bookings = Booking::with('items.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        $totalBookings = Booking::where('user_id', Auth::id())->count();

        $completedBookings = Booking::where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->count();

        $activeBookings = Booking::where('user_id', Auth::id())
            ->where('status', 'aktif')
            ->count();

        return view('dashboard.index', compact(
            'bookings',
            'totalBookings',
            'completedBookings',
            'activeBookings'
        ));
    }
}
