<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // ini untuk total produk
        $totalProducts = Product::count();

        // ini untuk Booking
        $totalBookings = Booking::count();

        // ini untuk rental aktif
        $activeRentals = Booking::where('status', 'aktif')->count();

        // ini untuk total monthlyRevenue
        $monthlyRevenue = Booking::where('status', 'selesai')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');

        // ini untuk Booking terbaru
        $recentBookings = Booking::with('product')->latest()->take(5)->get();

        // ini untuk stok menipis
        $lowStockItems = Product::where('stock', '<=', 4)->get();

        // ini untuk chart flexibel
        $range = $request->get('range', 7);

        $stats = [];
        $labels = [];

        if ($range == 7) {
            $step = 1;
        } elseif ($range == 30) {
            $step = 3; // ambil tiap 3 hari
        } else {
            $step = 7; // ambil per minggu
        }

        for ($i = $range - 1; $i >= 0; $i -= $step) {
            $date = now()->subDays($i);

            $count = Booking::whereDate('start_date', $date->toDateString())->count();

            $stats[] = $count;
            $labels[] = $date->translatedFormat('d M');
        }

        $max = max($stats) ?: 1;

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalBookings',
            'activeRentals',
            'monthlyRevenue',
            'recentBookings',
            'lowStockItems',
            'stats',
            'labels',
            'max',
            'range'
        ));
    }
}
