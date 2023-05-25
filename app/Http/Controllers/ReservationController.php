<?php

namespace App\Http\Controllers;
use App\Models\{Room,Reservation};
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
       $room = Room::findOrFail($request->room_id);

       /**
        * if ($room->status) {
        *return response()->json('Reservation is unavailable, room already reserved');
       *}
        */

        $arrival = Carbon::parse($request->arrival);
        $departure = Carbon::parse($request->departure);

        $conflictingReservation = Reservation::where('room_id', $room->id)->where(function($query) use ($arrival, $departure){
            //check if new reservation overlaps the current one
            $query->where(function ($query) use ($arrival, $departure){
                $query->where('arrival', '>=', $arrival)
                      ->where('departure', '<=', $departure);
            })->orWhere(function ($query) use ($arrival, $departure){
                $query->where('departure', '>=', $arrival)
                      ->where('departure', '<=', $departure);
            }); 
        })
        ->first();

        if ($conflictingReservation) {
            return response()->json(['error' => 'Cannot make Reservation. A conflicting reservation exists'], 400);
        }



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

    /**
     * $room->status = 1;
     * $room->save();
     */

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
        $room =$reservation->room;
        $reservation->delete();

        $room->status = 0;
        $room->save();

        return 'reservation removed';

    }
}
