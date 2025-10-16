<?php

namespace App\Http\Controllers\admin;

use App\Models\Klinik;
use App\Models\Pesanan;
use App\Models\Grooming;
use App\Models\PetHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardAdminController
{
    public function index()
    {
        $currentYear = Carbon::now()->year;
        $startYear = $currentYear - 4; // 5 tahun terakhir

        // Booking layanan
        $petHotelBookings = PetHotel::where('status', 'booking')->count();
        $groomingBookings = Grooming::where('status', 'booking')->count();
        $petklinikBookings = Klinik::where('status', 'booking')->count();
        $pesananInProgress = Pesanan::where('status', 'sedang_diproses')->count();

        // Penjualan Bulanan
        $salesMonthly = Pesanan::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(totalharga) as total')
        )
            ->where('status_pembayaran', 'paid')
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();

        $months = [];
        $totals = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthData = $salesMonthly->firstWhere('month', $i);
            $months[] = Carbon::create()->month($i)->format('F'); // nama bulan
            $totals[] = $monthData ? $monthData->total : 0;
        }

        // Penjualan Tahunan (5 tahun terakhir)
        $salesYearly = Pesanan::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(totalharga) as total')
        )
            ->where('status_pembayaran', 'paid')
            ->whereYear('created_at', '>=', $startYear)
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy('year')
            ->get();

        $years = [];
        $totalsYearly = [];
        for ($y = $startYear; $y <= $currentYear; $y++) {
            $yearData = $salesYearly->firstWhere('year', $y);
            $years[] = $y;
            $totalsYearly[] = $yearData ? $yearData->total : 0;
        }

        return view('admin.dashboard.index', compact(
            'petHotelBookings',
            'groomingBookings',
            'petklinikBookings',
            'pesananInProgress',
            'months',
            'totals',
            'years',
            'totalsYearly'
        ));
    }
}
