<?php

namespace App\Http\Controllers;
use App\Models\{Room,Reservation};
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Reservation::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[ 
            'reservation_no' => 'required',
            'name'=> 'required',
            'arrival' => 'required',
            'departure' => 'required',
            'payment' => 'required',
            'room_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json('Please fill all the fields',400);
        }

        Reservation::create([
            'reservation_no' => $request->reservation_no,
            'name' => $request->name,
            'arrival' => $request->arrival,
            'departure' => $request->departure,
            'payment' => $request->payment,
            'room_id' => $request->room_id
        ]);

        return 'Reservation made';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Reservation::find($id);
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
        $reservation = Reservation::find($id);
        $reservation->update($request->all());

        return 'reservation reaffirmed';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return 'reservation removed';

    }
}
