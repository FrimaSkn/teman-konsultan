<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(){
        return view('backend.packages.index');
    }

    public function create(){
        return view('backend.packages.create');
    }
}
