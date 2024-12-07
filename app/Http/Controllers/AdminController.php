<?php

namespace App\Http\Controllers;

use App\Models\Tenant;

class AdminController extends Controller
{
    // Show overdue tenants
    public function showOverdueTenants()
    {
        // Get all overdue tenants
        $overdueTenants = Tenant::overdue()->get();

        // Pass overdue tenants to a view
        return view('admin.overdue-tenants', compact('overdueTenants'));
    }
}

