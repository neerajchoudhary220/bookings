<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovieListResource;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function list(Request $request){
        $movies = Movie::paginate($request->per_page??10);
        return MovieListResource::collection($movies);
        
    }
}
