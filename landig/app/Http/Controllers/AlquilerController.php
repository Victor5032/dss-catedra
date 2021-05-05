<?php

namespace App\Http\Controllers;

use Cookie;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AlquilerController extends Controller
{
    public function alquileres()
    {
        $client = new Client();

        if (intval(Cookie::get('is_admin')) === 0) {
            $url = "http://localhost:8000/api/rents/user";
            $title = "Mis alquileres";
        } else {
            $url = "http://localhost:8000/api/rents";
            $title = "Alquileres";
        }

        $response = $client->get($url, [
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Cookie::get('Bearer'),
            ]
        ]);

        $sale = json_decode($response->getBody());

        if (empty($sale)) {
            $data = [
                'message' => "No se han efectuado alquileres"
            ];
        } else {
            $data = $sale;
        }
        
        return view('alquiler', compact('data', 'title'));
    }

    public function detalles(int $id)
    {
        $client = new Client();

        $url = "http://localhost:8000/api/rents/{$id}";

        $response = $client->get($url, [
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Cookie::get('Bearer'),
            ]
        ]);

        $data = json_decode($response->getBody());
        
        return view('detalles_alquiler', compact('data'));
    }

    public function alquiler(int $id)
    {
        $client = new Client();

        $data = [
            'start' => Carbon::now()->format('Y-m-d'),
            'end' => Carbon::now()->addMonth()->format('Y-m-d'),
        ];

        $url = "http://localhost:8000/api/rents/{$id}";

        $response = $client->post($url, [
            'json' => $data,
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Cookie::get('Bearer'),
            ]
        ]);

        $body = json_decode($response->getBody());

        return redirect()->route('detallesalquiler', ['rent' => $body->id])->with([
            'message' => "Alquiler realizado con exito",
            'type' => 'success'
        ]);

        // return response("alquiler {$id}");
        // return response()->json($body, 200);
    }
}
