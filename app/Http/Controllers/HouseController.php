<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Ensure Storage is imported

class HouseController extends Controller
{
    public function index()
    {
        $houses = House::all(); // Retrieve all houses
        return view('houses.index', compact('houses'));
    }

    public function create()
    {
        return view('houses.create'); // Show form to create a house
    }

    public function store(Request $request)
    {
        $request->validate([
            'houseName' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $house = new House();
        $house->houseName = $request->input('houseName');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('houses', 'public');  // Store image in 'public/houses' directory
            $house->image = $imagePath;
        }

        $house->save();

        // Flash success message with custom key for success
        session()->flash('success', 'House "' . $house->houseName . '" added successfully!');
        
        return redirect()->route('houses.index');
    }

    public function edit(House $house)
    {
        return view('houses.edit', compact('house')); // Show form to edit house
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'houseName' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $house = House::findOrFail($id);
        $house->houseName = $request->input('houseName');
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($house->image) {
                Storage::delete('public/' . $house->image);
            }
            $imagePath = $request->file('image')->store('houses', 'public');
            $house->image = $imagePath;
        }
    
        $house->save();
    
        // Flash success message with custom key for success
        session()->flash('success', 'House "' . $house->houseName . '" updated successfully!');
    
        return redirect()->route('houses.index');
    }

    public function destroy(House $house)
    {
        $house->delete(); // Delete house
        return redirect()->route('houses.index')->with('success', 'House deleted successfully!');
    }
}
