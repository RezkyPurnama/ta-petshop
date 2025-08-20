<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

class KucingController
{
    public function index()
    {
        return view('user.halaman.kucing');
    }
}
