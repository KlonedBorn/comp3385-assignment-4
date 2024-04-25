<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = \App\Models\Movie::all();
        return response()->json([
            'message' => 'Movie created successfully',
            'movies' => $movies->toArray()
        ]);
    }

    public function store(Request $movie_request): JsonResponse
    {
        $movie_request->validated(
            [
                'title' => 'required',
                'description' => 'required',
                'poster' => 'required|image|max:12288'
            ]
        );

        $poster = $movie_request->file('poster')->storeAs(
            'images',
            $movie_request->file('poster')->getClientOriginalName(),
            'public'
        );

        $movie = Movie::create($movie_request->only('title', 'description') + ['poster' => $poster]);

        return response()->json([
            'message' => 'Movie created successfully',
            'movie' => $movie
        ]);
    }
}
