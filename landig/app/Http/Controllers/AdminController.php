<?php

namespace App\Http\Controllers;

use Cookie;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function administradores()
    {
        $client = new Client();

        $url = "http://localhost:8000/api/auth/users";

        $response = $client->request('GET', $url, [
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Cookie::get('Bearer'),
            ]
        ]);

        $data =  json_decode($response->getBody());

        return view('admin', compact('data'));
    }

    public function nuevo(Request $request)
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

        $response = $client->post('http://localhost:8000/api/auth/register', [
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
            
            return redirect()->route('administradores')->with([
                'message' => $body->message,
                'type' => 'success'
            ]);
        }
    }
}
