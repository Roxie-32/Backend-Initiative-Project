<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalRequest;
use App\Http\Resources\Rental\Rental as RentalResource;
use App\Http\Resources\Rental\RentalCollection;
use App\Models\Rental;
use Illuminate\Http\Request;



class RentalController extends Controller
{
  //Using Form Request to peform validations while resources and collections to return response to improve code readability.


  //Show all Rentals
    public function index()
    {
        return  new RentalCollection(Rental::all());
    }

        //Create A Rental
    public function store(RentalRequest $request)
    {
        $rental = Rental::create([
            'movie_title' => $request->input('movie_title'),
            'datetime' => $request->input('datetime'),
          
        ]);

        return new RentalResource($rental);
    }

    //Get a particular Rental
    public function show(Rental $rental)
    {
        return new RentalResource($rental);
    }

    //Update A Rental
    public function update(RentalRequest $request, Rental $rental)
    {
     $rental->update($request->all());
     return new RentalResource($rental);
    }

    //Delete A Rental
        public function destroy(Rental $rental)
    {
        $rental->delete();
        return response()->json(['rental'=>'Rental Deleted'], 200);
       
    }
        
    }

