<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class RoomsController extends Controller
{
    //
    public function home()
    {
        return view('rooms.index');
    }

    public function rooms()
    {
        $room = Room::all();
        
        return DataTables::of($room)
            ->addIndexColumn()
            ->addColumn('images', function($room){
                $images = asset("storage/files/$room->images");
                // return '<img src='.$images.' border="0" width="40" align="center" />';
                return '<img src="'.$images.'" style="height: 100px; width: 150px;"/>';
            })
            
            ->addColumn('action', function ($room) {
                return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $room->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $room->id . '"><i class="ph-trash"></i></a>';
            })
            
            ->rawColumns(['action','images'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rule = [
            'name_room' => 'required',
            'capacity_room' => 'required',
            'facility_room' => 'required',
            'images_room' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $message = [
            'name_room.required' => 'This field is required',
            'capacity_room.required' => 'This field is required',
            'facility_room.required' => 'This field is required',
            'images_room.required' => 'This field is required',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $path = 'files/';
            $images_room = $request->file('images_room');
            $format_name_images_room = time().'.'.$images_room->extension();
            $images_room->storeAs($path, $format_name_images_room,'public');

            $ajax = new Room();
            $ajax->name = $request->input('name_room');
            $ajax->capacity = $request->input('capacity_room');
            $ajax->facility = $request->input('facility_room');
            $ajax->images = $format_name_images_room;
            $ajax->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data saved successfully',
            ]);
        }
    }

    public function edit($id)
    {
        //
        $room = Room::find($id);
        if ($room) {
            return response()->json([
                'status' => 200,
                'room' => $room,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Rooms not found',
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
           $rule = [
            'edit_name_room' => 'required',
            'edit_capacity_room' => 'required',
            'edit_facility_room' => 'required'
        ];

        $message = [
            'edit_name_room.required' => 'This field is required',
            'edit_capacity_room.required' => 'This field is required',
            'edit_facility_room.required' => 'This field is required'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $ajax = Room::find($id);

            if($ajax)
            {

                $ajax->name = $request->input('edit_name_room');
                $ajax->capacity = $request->input('edit_capacity_room');
                $ajax->facility = $request->input('edit_facility_room');

                if($request->hasFile('edit_images_room'))
                {
                    $path = 'storage/files/'.$ajax->images;
                    if(File::exists($path))
                    {
                        File::delete($path);
                    }
                    $images_room = $request->file('edit_images_room');
                    $format_name_images_room = time().'.'.$images_room->extension();
                    $images_room->move('storage/files/', $format_name_images_room);
                    $ajax->images = $format_name_images_room;
                }

                $ajax->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data updateds successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data not found',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        $deletedFile  = File::delete("storage/files/".$room->images);
        if(File::exists($deletedFile)) {
            File::delete($deletedFile);
        }
        $room->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been remove'
        ]);
    }
}
