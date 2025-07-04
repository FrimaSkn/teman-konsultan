<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageCategoryController extends Controller
{
    public function index()
    {
        return view('backend.packages.category.index');
    }

    public function create()
    {
        return view('backend.packages.category.create');
    }
}
