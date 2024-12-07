<?php

namespace App\Http\Controllers;

use App\Models\Tenant;  // Corrected import statement
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TenantController extends Controller
{

    
    public function index()
    {
        $tenants = Tenant::with('room')->get(); // Retrieve all tenants with their associated room
        return view('tenants.index', compact('tenants'));
    }

    public function create()
    {
        $rooms = Room::whereDoesntHave('tenants', function ($query) {
            $query->havingRaw('COUNT(*) >= rooms.max_tenants');
        })->get();
    
        return view('tenants.create', compact('rooms'));
    }
    

    // Store method in your Controller
    public function store(Request $request)
{
    // Validate incoming data
    $validated = $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email|unique:tenants,email',
        'room_ID' => 'required|exists:rooms,id',
        'date_in' => 'required|date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image file
    ]);

    $room = Room::find($validated['room_ID']);

    // Check if the room has reached its maximum tenant capacity
    if ($room->tenants()->count() >= $room->max_tenants) {
        return redirect()->back()->with('error', 'The selected room has reached its maximum capacity.');
    }

    // Handle Image Upload (if present)
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('tenants_images', 'public'); // Store image in storage/app/public/tenants_images
    }

    // Create a new tenant
    Tenant::create([
        'firstName' => $request->firstName,
        'lastName' => $request->lastName,
        'email' => $request->email,
        'room_ID' => $request->room_ID,
        'date_in' => $request->date_in,
        'image' => $imagePath,  // Store image path in database
    ]);

    return redirect()->route('tenants.index')->with('success', 'Tenant added successfully.');
}



    public function edit(Tenant $tenant)
    {
        $rooms = Room::all(); // Get all rooms for the edit form
        return view('tenants.edit', compact('tenant', 'rooms')); // Show edit form with tenant details
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'room_ID' => 'required|exists:rooms,id',
            'date_in' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // image validation
        ]);
    
        // Find the tenant
        $tenant = Tenant::findOrFail($id);
    
        // Update the tenant's information
        $tenant->firstName = $request->firstName;
        $tenant->lastName = $request->lastName;
        $tenant->email = $request->email;
        $tenant->room_ID = $request->room_ID;
        $tenant->date_in = $request->date_in;
    
        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image from storage if it exists
            if ($tenant->image) {
                Storage::delete('public/' . $tenant->image);
            }
    
            // Store the new image and get the path
            $path = $request->file('image')->store('tenant_images', 'public');
    
            // Update the tenant's image field with the new image path
            $tenant->image = $path;
        }
    
        // Save the updated tenant record
        $tenant->save();
    
        // Redirect back with a success message
        return redirect()->route('tenants.index')->with('success', 'Tenant updated successfully.');
    }
    

    public function destroy(Tenant $tenant)
    {
        $tenant->delete(); // Delete tenant
        return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully!');
    }


}
