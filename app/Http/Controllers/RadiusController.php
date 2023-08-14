<?php

namespace App\Http\Controllers;

use App\Models\Radiusmap;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class RadiusController extends Controller
{
    public function index()
    {
        return view('radius.index');
    }

    public function fetch()
    {
        $radius = Radiusmap::all();
        return DataTables::of($radius)
            ->addIndexColumn()
            ->addColumn('action', function ($radius) {
                return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $radius->id . '"><i class="ph-pencil-simple"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit($id)
    {
        //
        $radius = Radiusmap::find($id);
        if ($radius) {
            return response()->json([
                'status' => 200,
                'radius' => $radius,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Olt not found',
            ]);
        }
    }
    public function update(Request $request, string $id)
    {
            $activity = Radiusmap::find($id);
            $activity->value_setting = $request->input('edit_value_setting');

            $activity->update();
            return response()->json([
                'status' => 200,
                'message' => 'Data has been changed!',
            ]);
    }
}
