<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Movie;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $sales = Sale::select('sales.id', 'users.names', 'users.lastnames', 'movies.title', 'sales.total', 'sales.created_at')
                ->join('movies', 'movies.id', '=', 'sales.movie_id')
                ->join('users', 'users.id', '=', 'sales.user_id')
                ->orderBy('created_at', 'DESC')
                ->get();
        
        return $sales;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $id)
    {
        $movieSale = Movie::where('id', $id)->get()->pluck('rent_price');
        $movieStock = Movie::where('id', $id)->get()->pluck('stock');

        $stock = intval($movieStock[0]) - 1;

        Movie::where('id', $id)->update(['stock' => $stock]);

        $newSale = new Sale([
            'user_id' => auth('api')->user()->id,
            'movie_id' => $id,
            'total' => doubleval($movieSale[0]),
        ]);

        $newSale->save();
        
        return $newSale;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $sale = Sale::select('sales.id', 'users.names', 'users.lastnames', 'movies.title', 'movies.poster', 'sales.total', 'sales.created_at')
                ->join('movies', 'movies.id', '=', 'sales.movie_id')
                ->join('users', 'users.id', '=', 'sales.user_id')
                ->where('sales.id', $id)
                ->orderBy('sales.created_at', 'DESC')
                ->get();
        
        return $sale;
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

    public function usersales(Request $request)
    {   
        $sales = Sale::select('sales.id', 'movies.title', 'sales.total', 'sales.created_at')
                ->join('movies', 'movies.id', '=', 'sales.movie_id')
                ->where('sales.user_id', $request->user()->id)
                ->orderBy('sales.created_at', 'DESC')
                ->get();
        
        return $sales;
    }
}
