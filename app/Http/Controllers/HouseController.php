<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

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
        ]);

        House::create($request->all()); // Save new house
        return redirect()->route('houses.index')->with('success', 'House added successfully!');
    }

    public function edit(House $house)
    {
        return view('houses.edit', compact('house')); // Show form to edit house
    }

    public function update(Request $request, House $house)
    {
        $request->validate([
            'houseName' => 'required|string|max:255',
        ]);

        $house->update($request->all()); // Update house
        return redirect()->route('houses.index')->with('success', 'House updated successfully!');
    }

    public function destroy(House $house)
    {
        $house->delete(); // Delete house
        return redirect()->route('houses.index')->with('success', 'House deleted successfully!');
    }
}
