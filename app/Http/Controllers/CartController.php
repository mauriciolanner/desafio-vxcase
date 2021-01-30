<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Product;
use Carbon\Carbon;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function apiCart()
    {
        //status do carrinho 
        // 0 Não finalizado
        // 1 Finalizado

        $cart = Cart::select(
            'products.name',
            'products.image',
            'products.id as produc_id',
            'items.id as item_id',
            'prices.amount'
        )->Join('items', 'carts.id', '=', 'items.cart_id')
            ->Join('products', 'products.id', '=', 'items.product_id')
            ->join('prices', 'prices.product_id', '=', 'products.id')
            ->where('carts.user_id', auth()->user()->id)->where('status', 0)
            ->where('items.deleted_at', null)
            ->where('prices.deleted_at', null)
            ->get();

        return $cart;
    }

    public function apiAddCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|int|exists:products,id',
            'price_id' => 'required|int|exists:prices,id',
        ]);

        $cart = Cart::where('user_id', 1)->where('status', 0)->first();

        if ($cart == null) {
            $cart = Cart::create([
                'user_id' => auth()->user()->id,
                'status' => 0
            ]);
        }

        $item = Item::create([
            'product_id' => $request->product_id,
            'price_id' => $request->price_id,
            'cart_id' => $cart->id,
        ]);

        if ($item == null) {
            return json_encode(false);
        }

        return json_encode(true);
    }

    public function deletCart(Request $request){
        $validated = $request->validate([
            'item_id' => 'required|int|exists:items,id',
        ]);
        
        $now = Carbon::now();

        $itemDelet = Item::find($request->item_id);
        $itemDelet->deleted_at = $now;
        $itemDelet->save();
        
        return true;
    }

    public function finishCart(){
        $cart = Cart::where('user_id', auth()->user()->id)->where('status', 0)->first();

        if($cart == null){
            return false;
        }

        $cartFinish = Cart::find($cart->id);
        $cartFinish->status = 1;
        $cartFinish->save();

        //retira o item do estoque
        $items = Item::select(
            'products.id',
            'stock'
        )
        ->where('cart_id', $cart->id)
        ->join('products', 'items.product_id', '=', 'products.id')
        ->get();

        foreach($items as $item){
            $product = Product::find($item->id);
            $product->stock = ($item->stock - 1);
            $product->save();
        }

        return true;
    }
}
