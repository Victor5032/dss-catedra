<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function inicio() 
    {
        $client = new Client();

        $url = "http://localhost:8000/api/movies";

        $response = $client->request('GET', $url, [
            'verify' => false
        ]);

        $data =  json_decode($response->getBody());

        return view('index', compact('data'));
    }
}
