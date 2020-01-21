<?php

namespace App\Http\Controllers;

use App\elements;
use Illuminate\Http\Request;

class ElementsController extends Controller
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
        
        for ($x = 0; $x < count($request['ConvertedData']['body']); $x++) {
            $elements = new elements();
            $object = $request['ConvertedData']['body'][$x];
            foreach($object as $key => $el){
                $elements->$key = $el;
                $elements->save();   
            };
        }; 
        return elements::all(); 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\elements  $elements
     * @return \Illuminate\Http\Response
     */
    public function show(elements $elements)
    {
        //
        $array = [];

        $elements = elements::select('name')->get();

        for ($x = 0; $x < count($elements); $x++) {
            array_push($array, $elements[$x]['name']);
        }; 

        return $array;
    }

    public function roadpass($id){

        $elements = elements::where('name', $id)->firstOrFail();
        return $elements;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\elements  $elements
     * @return \Illuminate\Http\Response
     */
    public function edit(elements $elements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\elements  $elements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, elements $elements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\elements  $elements
     * @return \Illuminate\Http\Response
     */
    public function destroy(elements $elements)
    {
        //
    }
}
