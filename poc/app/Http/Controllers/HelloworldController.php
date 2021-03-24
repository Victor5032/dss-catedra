<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HelloworldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = array(
            'mensaje' => "Hola mundo",
            'description' => "Esto es un endpoint",
            'integrantes' => array(
                array( 
                    'Alumno' => 'Gregory Alexis Mejía Choriego', 
                    'Carné' => 'MC19039' 
                ),
                array( 
                    'Alumno' => 'Victor José López Rivera', 
                    'Carné' => 'LR180820' 
                ),
                array( 
                    'Alumno' => 'Leonardo Manuel Mendoza Rodriguez', 
                    'Carné' => 'MR190336' 
                ),
                array( 
                    'Alumno' => 'Emerson Adonay López Maldonado', 
                    'Carné' => 'LM201989' 
                ), 
            )
        );

        $response = Response::json($message, 200);

        return $response;
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
