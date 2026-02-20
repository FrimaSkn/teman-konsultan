<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CartItem;

class CartController extends Controller
{
/**
 * Show the cart index page.
 *
 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
 */
    public function index()
    {
        return view('frontend.cart.index');
    }

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\RedirectResponse
 */
/**
 * Validate and store a cart item based on the given request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\RedirectResponse
 */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'package_id' => 'required',
            'slug' => 'required',
            'type' => 'required',
            'sub_package_key' => 'nullable',
            'min_contract' => 'required|integer|min:1',
            'contract_type' => 'nullable|string',
            'package_price' => 'required|integer',
        ]);

        // dd($validate);

        $validate['quantity'] = $validate['min_contract'];

        $store = CartItem::create([
            'user_id' => auth()->user()->id,
            'package_id' => (int) $validate['package_id'],
            'payload' => json_encode($validate),
            'quantity' => (int) $validate['quantity'],
            'min_contract' => (int) $validate['min_contract'],
            'contract_type' => $validate['contract_type'],
        ]);

        return redirect()->route('frontend.cart.index')->withFlashSuccess(__('Item added to cart successfully.'));
    }
}
