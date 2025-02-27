<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;
use App\Models\House;
use Illuminate\Support\Facades\Auth; // For Auth

class HouseController extends Controller
{
    /**
     * Show the form for creating a new house.
     *
     * @return \Illuminate\View\View

    /**
     * Store a newly created house in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     * 
     * 
     * 
     * 
     */

public function index($param){

    $houses=House::With(['category','equipement'])->paginate($param);
    // foreach($houses as $house){
    //     print_r($house);
    // }
    return view('paginate',compact('houses','param'));

}

    public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'equipements' => 'array',
        ]);

        // Proceed with storing data (Example: saving to database)
        // Model::create($validatedData);

    

    } catch (ValidationException $e) {
    
        dd($e->validator);
             // Keeps old input data
    } catch (\Exception $e) {
    dd('error', 'Something went wrong: ' . $e->getMessage());
    }
    
    $idOwner = auth()->user()->id;

    // if (!$idOwner) {
    //     return redirect()->back()->withErrors(['error' => 'User session expired. Please try again.']);
    // }


    
    try {
        $house = House::create([
            'id_owner' => $idOwner,
            'title' => $request->title,
            'id_categorie' => $request->id_categorie,
            'description' => $request->description,
            'price' => $request->price,
        ]);
    
        if ($request->has('equipements') && is_array($request->equipements)) {
            $house->equipements()->attach($request->equipements);
        }
        
    
        return redirect()->back()->with('message', 'House created successfully!');
    } catch (ValidationException $e) {
        // Flash the validation errors to the session
        dd('hhhhhh');
        // return redirect()->back()->withErrors($e->validator)->withInput();
    } catch (QueryException $e) {
        dd($e);
        // return redirect()->back()->with('error', 'Database error: ' . $e->getMessage())->withInput();
    } catch (\Exception $e) {
        dd($e);
        // return redirect()->back()->with('error', 'Unexpected error: ' . $e->getMessage())->withInput();
    }}


} 