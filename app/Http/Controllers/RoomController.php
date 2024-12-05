<?php
// app/Http/Controllers/RoomController.php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\House;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Display all rooms
    public function index()
    {
        $rooms = Room::all(); // Fetch all rooms from the database
        return view('rooms.index', compact('rooms')); // Pass rooms to the view
    }

    // Show the form to create a new room
    public function create()
    {
        $houses = House::all(); // Fetch all houses for the select dropdown
        return view('rooms.create', compact('houses')); // Pass houses to the form
    }

    // Store a new room in the database
    public function store(Request $request)
    {
        $request->validate([
            'house_id' => 'required|exists:_houses,id', // Ensure house_id exists in _houses table
            'roomName' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'max_tenants' => 'required|integer|min:1',
        ]);

        // Create the room record
        Room::create([
            'house_id' => $request->house_id,
            'roomName' => $request->roomName,
            'price' => $request->price,
            'description' => $request->description,
            'max_tenants' => $request->max_tenants,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room added successfully!');
    }

    // Show the form to edit a room
    public function edit(Room $room)
    {
        $houses = House::all(); // Retrieve all houses
        return view('rooms.edit', compact('room', 'houses'));
    }
    

    // Update the room in the database
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'house_id' => 'required|exists:_houses,id', // Ensure that house_id is valid
            'roomName' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'max_tenants' => 'required|integer|min:1',
        ]);
    

        $room->update($request->all());
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully!');
    }

    // Delete a room
    public function destroy(Room $room)
    {
        $room->delete(); // Delete the room

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully!');
    }
}
