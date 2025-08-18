<?php

namespace App\Http\Controllers\admin;

use App\Models\Grooming;
use App\Models\Klinik;
use App\Models\PetHotel;
use Illuminate\Http\Request;

class DashboardAdminController
{
    public function index()
    {
        // Menghitung jumlah pet hotel dengan status 'booking'
        $petHotelBookings = PetHotel::where('status', 'booking')->count();
        $groomingBookings = Grooming::where('status', 'booking')->count();
        $petklinikBookings = Klinik::where('status', 'booking')->count();

        return view('admin.dashboard.index', compact('petHotelBookings', 'groomingBookings', 'petklinikBookings'));
    }
}
