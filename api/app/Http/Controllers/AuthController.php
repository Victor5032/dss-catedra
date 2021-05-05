<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup(SignupRequest $request)
    {
        
        $data = $request->validated();

        $user = new User([
            'names' => $request->names,
            'lastnames' => $request->lastnames,
            'username' => $request->username,
            'is_admin' => false,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        $user->save();

        return response()->json([
            'message' => 'Usuario ingresado exitosamente',
            'user' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember' => 'boolean',
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => "Usuario no encontrado"
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'is_admin' => $user->is_admin
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Cierre de sesión exitoso'
        ], 200);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function users()
    {
        $users = User::where('is_admin', 1)->get();

        return $users;
    }

    public function register(SignupRequest $request)
    {
        
        $data = $request->validated();

        $user = new User([
            'names' => $request->names,
            'lastnames' => $request->lastnames,
            'username' => $request->username,
            'is_admin' => true,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        $user->save();

        return response()->json([
            'message' => 'Administrador ingresado exitosamente',
            'user' => $user
        ], 200);
    }

    /* public function new(SignupRequest $request)
    {
        $data = $request->validated();

        $user = new User([
            'names' => $request->names,
            'lastnames' => $request->lastnames,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        $user->save();

        return response()->json([
            'message' => 'Usuario ingresado exitosamente',
            'user' => $user
        ], 200);
    } */
}
