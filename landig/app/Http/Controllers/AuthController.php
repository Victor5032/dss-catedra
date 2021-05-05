<?php

namespace App\Http\Controllers;

use Cookie;
use DateTime;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('registro');
    }

    public function registrar(Request $request)
    {
        $client = new Client();

        $data = array(
            'names' => $request->names,
            'lastnames' => $request->lastnames,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        );

        $response = $client->post('http://localhost:8000/api/auth/signup', [
            'json' => $data,
            'http_errors' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

        if ($response->getStatusCode() == 422) {
            $errorsResult = json_decode($response->getBody()->getContents());
            $errors = $errorsResult->errors;
            
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            $body = json_decode($response->getBody());
            
            return redirect()->route('login')->with([
                'message' => $body->message,
                'type' => 'success'
            ]);
        }
    }

    public function login(Request $request)
    {
        $client = new Client();

        $data = array(
            'email' => $request->email,
            'password' => $request->password,
        );

        $response = $client->post('http://localhost:8000/api/auth/login', [
            'json' => $data,
            'http_errors' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
        
        $body = json_decode($response->getBody());
        
        if (isset($body->message)) {
            return redirect()->route('login')->with([
                'message' => $body->message,
                'type' => 'danger'
            ]);
        } else {
            // var_dump($body);
            $cookieBearer = Cookie::make('Bearer', $body->access_token, 525600);
            $cookieAdmin = Cookie::make('is_admin', $body->is_admin, 525600);

            return redirect()->route('home')->with([
                'message' => "Bienvenido",
                'type' => 'success'
            ])
            ->withCookie($cookieBearer)
            ->withCookie($cookieAdmin);
        }
    }

    public function logout()
    {
        $client = new Client();

        $response = $client->get('http://localhost:8000/api/auth/logout', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Cookie::get('Bearer'),
            ]
        ]);

        $body = json_decode($response->getBody());

        $cookieBearer = Cookie::forget('Bearer');
        $cookieAdmin = Cookie::forget('is_admin');

        return redirect()->route('home')->with([
            'message' => $body->message,
            'type' => 'success'
        ])
        ->withCookie($cookieBearer)
        ->withCookie($cookieAdmin);
    }

    public function perfil()
    {
        $client = new Client();

        $response = $client->get('http://localhost:8000/api/auth/user', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Cookie::get('Bearer'),
            ]
        ]);

        $body = json_decode($response->getBody());

        $data = array(
            'names' => $body->names,
            'lastnames' => $body->lastnames,
            'username' => $body->username,
            'email' => $body->email
        );

        return view('perfil')->with('data', $data);
    }
}
