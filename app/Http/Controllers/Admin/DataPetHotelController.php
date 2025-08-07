<?php

namespace App\Http\Controllers\admin;

use App\Models\PetHotel;
use Illuminate\Http\Request;

class DataPetHotelController
{
    public function index()
    {
        $pethotels = PetHotel::latest()->paginate(10);
        return view('admin.pet-hotel.index', compact('pethotels'));
    }
}
