<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HouseController extends Controller
{
    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;

class HouseController extends Controller
{
    public function create()
    {
        return view('houses.create'); // Return the form view
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'id_owner' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'id_categorie' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'equipements' => 'array',
            'equipements.*' => 'exists:equipements,id',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('houses', 'public'); // Store image in public storage
        }

        // Create the house
        $house = House::create([
            'id_owner' => $request->id_owner,
            'title' => $request->title,
            'id_categorie' => $request->id_categorie,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        // Attach equipements if provided
        if ($request->has('equipements')) {
            $house->equipements()->attach($request->equipements);
        }

        return redirect()->route('houses.index')->with('success', 'House created successfully!');
    }
}

}
