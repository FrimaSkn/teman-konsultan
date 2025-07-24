<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(){
        return view('backend.packages.index');
    }

    public function create(){
        return view('backend.packages.create');
    }

    public function edit(Package $package){
        return view('backend.packages.edit', [
            'package' => $package,
        ]);
    }
}
