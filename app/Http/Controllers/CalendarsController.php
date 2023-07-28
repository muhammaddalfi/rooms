<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarsController extends Controller
{
    //
    public function home()
    {
        return view('calendars.index');
    }
}
