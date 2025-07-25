<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PackageCategory;
use PhpParser\Node\Stmt\Return_;

class ChargeController extends Controller
{
    public function index()
    {
        return view('frontend.pages.charge', [
            'categories' => PackageCategory::with('packages')->Published()->get(),
        ]);
    }
}
