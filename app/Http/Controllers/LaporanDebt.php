<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanDebt extends Controller
{
    public function index(){
        return view('baddeb.laporan');
    }
}
