<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalRequest;
use App\Http\Resources\Rental\Rental as RentalResource;
use App\Http\Resources\Rental\RentalCollection;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;



class RentalController extends Controller
{
  //Using Form Request to peform validations while resources and collections to return response to improve code readability.

  public function __construct()
  {
      $this->middleware('auth:sanctum');
  }

   

  //Show all Rentals
    public function index()
    {
        return  new RentalCollection(Rental::all());
    }

        //Create A Rental
    public function store(RentalRequest $request)
    {
        $user_id = auth()->user()->id;
        $rental = Rental::create([
            'movie_title' => $request->input('movie_title'),
            'datetime' => $request->input('datetime'),
            'user_id'=>$user_id,

          
        ]);

        return new RentalResource($rental);
    }

    //Get a particular Rental
    public function show(Rental $rental)
    {
        
        $user_id = auth()->user()->id;
        $check = Rental::where('user_id',$user_id)->get();
        if(count($check)==0) {
            return response()->json(['message'=>'Document not found'],404);
        }
        return new RentalResource($rental);
    }

    //Update A Rental
    public function update(RentalRequest $request, Rental $rental)
    {
        $user_id = auth()->user()->id;
        $check = Rental::where('user_id',$user_id)->get();
        if(count($check)==0) {
            return response()->json(['message'=>'Document not found'],404);
        }
     $rental->update($request->all());
     return new RentalResource($rental);
    }

    //Delete A Rental
        public function destroy(Rental $rental)
    {
        $user_id = auth()->user()->id;
        $check = Rental::where('user_id',$user_id)->get();
        if(count($check)==0) {
            return response()->json(['message'=>'Document not found'],404);
        }
        $rental->delete();
        return response()->json(['rental'=>'Rental Deleted'], 200);
       
    }
        
    }

