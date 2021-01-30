<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(){

        $products = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.stock',
            'products.delivery_days',
            'products.reference',
            'products.image',
            'prices.amount',
            'prices.id as price_id'
        )
        ->join('prices', 'prices.product_id', '=', 'products.id')
        ->where('prices.deleted_at', null)
        ->paginate(10);

        return view('pages.store', compact('products'));
    }

}
