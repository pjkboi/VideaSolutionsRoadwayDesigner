<?php

namespace App\Http\Controllers;

use App\submissions;
use Illuminate\Http\Request;

class SubmissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $object = $request['UserSaved'];
        $submissions = new submissions();
        foreach($object as $key => $el){
            $submissions->$key = $el;
            $submissions->save();   
        };
        return submissions::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\submissions  $submissions
     * @return \Illuminate\Http\Response
     */
    public function show(submissions $submissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\submissions  $submissions
     * @return \Illuminate\Http\Response
     */
    public function edit(submissions $submissions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\submissions  $submissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, submissions $submissions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\submissions  $submissions
     * @return \Illuminate\Http\Response
     */
    public function destroy(submissions $submissions)
    {
        //
    }
}
