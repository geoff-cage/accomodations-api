<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Institution, Accomodation};
use Illuminate\Support\Facades\Validator;

class AccomodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Accomodation::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[ 
            'accomodation_no' => 'required',
            'accomodation_name' => 'required',
            'location' => 'required',
            'institution_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json('Please fill all the fields',400);
        }

        Accomodation::create([
            'accomodation_no' => $request->accomodation_no,
            'accomodation_name' => $request->accomodation_name,
            'location' => $request->location,
            'institution_id' => $request->institution_id
        ]);

        return 'Accomodation';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($institution_id)
    {
        return Accomodation::where('id', $institution_id); // if i use 'Accomodation::find($institution_id)' it brings by accomodation id and not institution id
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
