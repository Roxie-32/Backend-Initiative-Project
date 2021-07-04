<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Resources\Movie\Movie as MovieResource;
use App\Http\Resources\Movie\MovieCollection;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
  //Using Form Request to peform validations while resources and collections to return response to improve code readability.

  public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    //Show all movies
    public function index()
    {
        
        return  new MovieCollection(Movie::all());
    }

    //Create a new movie
    public function store(MovieRequest $request)
    {
        $movie = Movie::create([
            'title' => $request->input('title'),
            'release_date' => $request->input('release_date'),
            'genre' => $request->input('genre'),
            'producer' => $request->input('producer'),
            'synopsis' => $request->input('synopsis'),
            'user_id'=>auth()->user()->id,
        ]);

        return new MovieResource($movie);
    }


    //Get a particular movie
    public function show(Movie $movie)
    {
        $user_id = auth()->user()->id;
        $check = Movie::where('user_id',$user_id)->get();
        if(count($check)==0) {
            return response()->json(['message'=>'Document not found'],404);
        }
        return new MovieResource($movie);
    }

  //Update a Movie
    public function update(MovieRequest $request, Movie $movie)
    {
        $user_id = auth()->user()->id;
        $check = Movie::where('user_id',$user_id)->get();
        if(count($check)==0) {
            return response()->json(['message'=>'Document not found'],404);
        }
     $movie->update($request->all());
     return new MovieResource($movie);
    }


    //Delete a movie
    public function destroy(Movie $movie)
    {
        $user_id = auth()->user()->id;
        $check = Movie::where('user_id',$user_id)->get();
        if(count($check)==0) {
            return response()->json(['message'=>'Document not found'],404);
        }
        $movie->delete();
        return response()->json(['movie'=>'Movie Deleted'], 200);
       
    }
}
