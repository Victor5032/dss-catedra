<?php

namespace App\Http\Controllers;

use Cookie;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function catalogo() 
    {
        $client = new Client();

        $url = "http://localhost:8000/api/movies";

        $response = $client->request('GET', $url, [
            'verify' => false
        ]);

        $data =  json_decode($response->getBody());

        return view('catalogo', compact('data'));
    }

    public function pelicula(int $id) 
    {
        $client = new Client();

        $url = "http://localhost:8000/api/movies/{$id}";

        $response = $client->request('GET', $url, [
            'verify' => false
        ]);

        $data =  json_decode($response->getBody());

        return view('movie', compact('data'));
    }

    public function inventario() 
    {
        $client = new Client();

        $url = "http://localhost:8000/api/movies";

        $response = $client->request('GET', $url, [
            'verify' => false
        ]);

        $data =  json_decode($response->getBody());

        return view('inventario', compact('data'));
    }

    public function inhabilitar(int $id, string $action)
    {
        $client = new Client();

        $url = "http://localhost:8000/api/movies/remove/{$id}?action={$action}";

        $response = $client->request('PUT', $url, [
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Cookie::get('Bearer'),
            ]
        ]);

        $body =  json_decode($response->getBody());

        if ($action == "remove") {
            $message = 'Se inhabilito del stock la pelicula "' . $body->title . '"';
            $type = "warning";
        } else {
            $message = 'Se habilito del stock la pelicula "' . $body->title . '"';
            $type = "success";
        }
        
        return redirect()->route('inventario')->with([
            'message' => $message,
            'type' => $type
        ]);
    }

    public function agregar(Request $request)
    {
        $client = new Client();

        $data = array(
            'title' => $request->title,
            'poster' => $request->poster,
            'description' => $request->description,
            'rent_price' => $request->rent_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
        );

        $response = $client->post('http://localhost:8000/api/movies', [
            'json' => $data,
            'http_errors' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Cookie::get('Bearer'),
            ]
        ]);

        if ($response->getStatusCode() == 422) {
            $errorsResult = json_decode($response->getBody()->getContents());
            $errors = $errorsResult->errors;
            
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            $body = json_decode($response->getBody());
            
            return redirect()->route('inventario')->with([
                'message' => "Pelicula agregada con exito",
                'type' => 'success'
            ]);
        }
    }

    public function eliminar(int $id)
    {
        $client = new Client();

        $response = $client->delete("http://localhost:8000/api/movies/{$id}", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Cookie::get('Bearer'),
            ]
        ]);

        $body = json_decode($response->getBody());

        return redirect()->route('inventario')->with([
            'message' => $body->message,
            'type' => $body->type,
        ]);
    }

    public function editar(int $id)
    {
        $client = new Client();

        $response = $client->get("http://localhost:8000/api/movies/{$id}", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);

        $data = json_decode($response->getBody());
        $route = route('actualizar', ['movie' => $id]);

        return view('formulario_pelicula', compact('data', 'route'));
    }

    public function actualizar(Request $request, int $id)
    {
        $client = new Client();

        $data = array(
            'title' => $request->title,
            'poster' => $request->poster,
            'description' => $request->description,
            'rent_price' => $request->rent_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
        );

        $response = $client->put("http://localhost:8000/api/movies/{$id}", [
            'json' => $data,
            'http_errors' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Cookie::get('Bearer'),
            ]
        ]);

        if ($response->getStatusCode() == 422) {
            $errorsResult = json_decode($response->getBody()->getContents());
            $errors = $errorsResult->errors;
            
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            $body = json_decode($response->getBody());
            
            return redirect()->route('inventario')->with([
                'message' => "Pelicula actualizada con exito",
                'type' => 'success'
            ]);
        }
    }
}
