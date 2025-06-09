<?php

namespace App\Http\Controllers\Backend;

use App\Models\ServicesCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesCategoryController extends Controller
{
    public function index()
    {
        return view('backend.services.category.index');
    }

    public function create()
    {
        return view('backend.services.category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Assuming you have a Service model to handle the creation
        ServicesCategory::create($validatedData);

        return redirect()->route('admin.services-category.index')->with('success', 'Service created successfully.');
    }
}
