<?php

namespace App\Http\Controllers\Backend;

use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{

    public function index()
    {
        return view('backend.services.index');
    }

    public function create()
    {
        $services = \App\Models\Services::all(); // Fetch all services for the dropdown
        return view('backend.services.create', [
            'services' => $services,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:services_categories,id', // Ensure the category exists
            'description' => 'nullable|string|max:1000', // Optional description
        ]);

        // Assuming you have a ServiceItem model to handle the creation
        Services::create([
            'category_id' => $validatedData['category'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'], // Optional description
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service item created successfully.');
    }

    public function edit(Services $service)
    {
        return view('backend.services.edit', [
            'service' => $service,
        ]);
    }
}
