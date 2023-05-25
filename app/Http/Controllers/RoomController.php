<?php

namespace App\Http\Controllers;
use App\Models\{Accomodation,Room};
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Room::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[ 
            'room_no' => 'required',
            'room_name',
            'price' => 'required',
            'type' => 'required',
            'status',
            'accomodation_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json('Please fill all the fields',400);
        }

        Room::create([
            'room_no' => $request->room_no,
            'room_name' => $request->room_name,
            'price' => $request->price,
            'type' => $request->type,
            'status' => $request->status,
            'accomodation_id' => $request->accomodation_id
        ]);

        return 'Room added';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Room::find($id);
    }

    public  function getReservations($room_id)
    {
        $room = Room::findOrFail($room_id);
        $reservations = $room->reservations;
    
    return response()->json($reservations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room = Room::find($id);
        $room->update($request->all());

        return $room;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $room = Room::find($id);
        $room->delete();

        return 'room removed';
    }

    public function search($type)
    {
        return Room::where('type', 'like', '%'.$type.'%')->get();
    }
}
