<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //
    public function home()
    {
        $data['room'] = Room::all();
        return view('reservations.index',$data);
    }
}
