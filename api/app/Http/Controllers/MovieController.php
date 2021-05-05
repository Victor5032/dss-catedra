<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests\NewMovieRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $movies = Movie::where('title', 'LIKE', '%', $request->search, '%')
                        ->orWhere('rent_price', $request->search)
                        ->orWhere('sale_price', $request->search)
                        ->get();
        } else {
            $movies = Movie::all();
        }

        return $movies;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewMovieRequest $request)
    {
        $data = $request->validated();

        $newMovie = Movie::create($data);

        return $newMovie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return $movie;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewMovieRequest $request, Movie $movie)
    {
        $data = $request->validated();

        $movie->update($data);

        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $status = $movie->delete();

        if ($status == 1) {
            $data = [
                'message' => "Pelicula eliminada correctamente",
                'type' => 'success'
            ];
        } else {
            $data = [
                'message' => "Error al eliminar pelicula",
                'type' => 'danger'
            ];
        }

        return response()->json($data);
    }

    // Remover o agregar pelicula del inventario
    public function vacancy(Request $request, Movie $movie)
    {
        if ($request->has('action')) {
            switch ($request->action) {
                case 'remove':
                    $status = 0;
                    break;
                    
                case 'add':
                    $status = 1;
                    break;
            }

            $movie->update([
                'status' => $status
            ]);
        }

        // return response()->json($request, 200);
        return $movie;
    }
}
