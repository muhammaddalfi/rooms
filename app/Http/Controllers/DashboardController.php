<?php

namespace App\Http\Controllers;

use App\Models\Daily;
use App\Models\Kegiatan;
use App\Models\Keluhan;
use App\Models\Olt;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function home()
    { 
       
         return view('dashboard.index');

    }


}

