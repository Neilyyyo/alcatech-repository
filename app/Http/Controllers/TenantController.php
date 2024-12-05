<?php

namespace App\Http\Controllers;

use App\Models\Tenant;  // Corrected import statement
use App\Models\Room;
use Illuminate\Http\Request;
 use Propaganistas\LaravelPhone\PhoneNumber;


class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('room')->get(); // Retrieve all tenants with their associated room
        return view('tenants.index', compact('tenants'));
    }

    public function create()
    {
        $rooms = Room::all(); // Get all rooms to select in the form
        return view('tenants.create', compact('rooms')); // Show the create form with rooms
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
            'guardian_name' => 'required|string|max:255',  // Make guardian_name required
            'guardian_contact' => 'required|phone:AUTO',  // Apply phone validation
        ]);
    
        // Create a new tenant
        Tenant::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'room_ID' => $request->room_ID,
            'date_in' => $request->date_in,
            'guardian_name' => $request->guardian_name,
            'guardian_contact' => $request->guardian_contact, // Store as a string
        ]);
    
        return redirect()->route('tenants.index')->with('success', 'Tenant added successfully!');
    }
    


    public function edit(Tenant $tenant)
    {
        $rooms = Room::all(); // Get all rooms for the edit form
        return view('tenants.edit', compact('tenant', 'rooms')); // Show edit form with tenant details
    }

    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email,' . $tenant->id,
            'room_ID' => 'required|exists:rooms,id',
            'date_in' => 'required|date',
        ]);

        $tenant->update($request->all()); // Update the tenant
        return redirect()->route('tenants.index')->with('success', 'Tenant updated successfully!');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete(); // Delete tenant
        return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully!');
    }
    
}
