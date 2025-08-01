<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

class DashboardAdminController
{
    public function index()
    {
    return view('admin.dashboard.index');
    }
}
