<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use Illuminate\Support\Facades\Validator;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Institution::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[ 
            'institution_no' => 'required',
            'name' => 'required',
            'owner' => 'required',
            'information' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json('Please fill all fields',400);
        }

        Institution::create([
            'institution_no' => $request->institution_no,
            'name' => $request->name,
            'owner' => $request->owner,
            'information' => $request->information
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * public function store(Request $request)
    *{
    *   $request->validate([
    *       'institution_no' => 'required',
    *       'name' => 'required',
    *       'owner' => 'required',
    *       'information' => 'required'
    *   ]);
    *   return Institution::create($request->all());
    *}
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Institution::find($id);
    }

    public  function getAccomodations($institution_id)
    {
        $institution = Institution::findOrFail($institution_id);
        $accomodations = $institution->accomodations;
    
    return response()->json($accomodations);
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
        $institution = Institution::find($id);
        $institution->update($request->all());
        return $institution;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Institution::destroy($id);
    }

    public function search($name)
    {
        return Institution::where('name', 'like', '%'.$name.'%')->get();
    }
}
