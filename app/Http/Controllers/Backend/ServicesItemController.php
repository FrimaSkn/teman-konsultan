<?php

namespace App\Http\Controllers\Backend;

use App\Models\ServicesCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesItemController extends Controller
{
    public function index()
    {
        return view('backend.services.category.index');
    }

    public function create()
    {
        $services = \App\Models\Services::all(); // Fetch all services for the dropdown
        return view('backend.services.category.create', [
            'services' => $services,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|exists:services,id',
            'description' => 'nullable|string|max:1000', // Optional description
        ]);

        // Assuming you have a ServiceItem model to handle the creation
        ServicesCategory::create([
            'service_id' => $validatedData['type'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'], // Optional description
        ]);

        return redirect()->route('admin.services-category.index')->with('success', 'Service item created successfully.');
    }
}
