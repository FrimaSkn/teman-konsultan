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
        return view('backend.services.create');
    }

    public function edit(Services $service)
    {
        return view('backend.services.edit', [
            'service' => $service,
        ]);
    }
}
