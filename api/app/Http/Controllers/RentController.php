<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Rent;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests\RentRequest;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rents = Rent::select('rents.id', 'users.names', 'users.lastnames', 'movies.title', 'rents.start_date', 'rents.end_date', 'rents.total', 'rents.created_at')
                ->join('movies', 'movies.id', '=', 'rents.movie_id')
                ->join('users', 'users.id', '=', 'rents.user_id')
                ->orderBy('created_at', 'DESC')
                ->get();
        
        return $rents;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $id)
    {
        $movieRent = Movie::where('id', $id)->get()->pluck('rent_price');

        $newRent = new Rent([
            'user_id' => auth('api')->user()->id,
            'movie_id' => $id,
            'start_date' => date('Y-m-d', strtotime($request->start)),
            'end_date' => date('Y-m-d', strtotime($request->end)),
            'total' => doubleval($movieRent[0]),
        ]);

        $newRent->save();

        return response()->json($newRent, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $rent = Rent::select('rents.id', 'users.names', 'users.lastnames', 'movies.title', 'movies.poster', 'rents.start_date', 'rents.end_date', 'rents.total', 'rents.created_at')
                ->join('movies', 'movies.id', '=', 'rents.movie_id')
                ->join('users', 'users.id', '=', 'rents.user_id')
                ->where('rents.id', $id)
                ->orderBy('rents.created_at', 'DESC')
                ->get();
        
        return $rent;
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

    public function userrents(Request $request)
    {   
        $rents = Rent::select('rents.id', 'movies.title', 'rents.start_date', 'rents.end_date', 'rents.total', 'rents.created_at')
                ->join('movies', 'movies.id', '=', 'rents.movie_id')
                ->where('rents.user_id', $request->user()->id)
                ->orderBy('rents.created_at', 'DESC')
                ->get();
        
        return $rents;
    }
}
