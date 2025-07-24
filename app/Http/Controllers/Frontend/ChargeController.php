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
        $this->getPackages();
        return view('frontend.pages.charge', [
            'packages' => $this->getPackages(),
            'categories' => PackageCategory::with('packages')->Published()->get(),
        ]);
    }

    public function getPackages()
    {
        $packages = \App\Models\Package::with('category')->get();

        $data = [];


        foreach ($packages as $package) {
            $wrapped = [
                'category_id' => $package->category_id,
                'category_slug' => $package->category->slug,
                'category_name' => $package->category->name,
                'layout' => $package->category->layout,
                'title' => $package->title,
                'slug' => $package->slug,
                'note' => $package->category->note ?? null,
            ];
            $mapped = Arr::mapWithKeys(json_decode($package->payload), function ($value,  $key) {
                return $value->data;
            });

            $pushed = Arr::map($mapped, function ($value, $key) use (&$wrapped) {
                return $wrapped[$key] = $value;
            });

            $data[] = json_decode((string) json_encode($wrapped), true);
        }

        // dd($data);

        return collect($data);
    }
}
