<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    //
     public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = bcrypt($request->input('password'));
        $user->update();
        return response()->json([
            'status' => 200,
            'message' => 'Password Berhasil diganti',
        ]);
    }
}
