<?php

namespace App\Http\Controllers;

use Cookie;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function compras()
    {
        $client = new Client();

        if (intval(Cookie::get('is_admin')) === 0) {
            $url = "http://localhost:8000/api/sales/user";
            $title = "Mis compras";
        } else {
            $url = "http://localhost:8000/api/sales";
            $title = "Compras";
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
                'message' => "No se han efectuado compras"
            ];
        } else {
            $data = $sale;
        }
        
        return view('compra', compact('data', 'title'));
        // return response()->json($data, 200);
    }

    public function detalles(int $id)
    {
        $client = new Client();

        $url = "http://localhost:8000/api/sales/{$id}";

        $response = $client->get($url, [
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Cookie::get('Bearer'),
            ]
        ]);

        $data = json_decode($response->getBody());
        
        return view('detalles_compra', compact('data'));
    }

    public function comprar(int $id)
    {
        $client = new Client();

        $url = "http://localhost:8000/api/sales/{$id}";

        $response = $client->post($url, [
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Cookie::get('Bearer'),
            ]
        ]);

        $data = json_decode($response->getBody());

        return redirect()->route('detallescompra', ['sale' => $data->id])->with([
            'message' => "Compra realizada con exito",
            'type' => 'success'
        ]);
    }
}
