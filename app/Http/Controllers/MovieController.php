<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        phpinfo(INFO_VARIABLES);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $posterName = time() . '.' . $request->poster->extension();

        $request->poster->move(public_path('posters'), $posterName);

        $movie = \App\Models\Movie::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'poster' => $posterName,
        ]);

        return response()->json([
            'message' => 'Movie created successfully',
            'movies' => $movie,
        ]);
    }
}
