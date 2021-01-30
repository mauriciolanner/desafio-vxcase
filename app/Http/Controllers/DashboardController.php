<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $shops = Cart::select(
            'carts.id',
            'carts.updated_at as data_create',
            'products.delivery_days',
            'users.name'
        )
            ->join('items', 'carts.id', '=', 'items.cart_id')
            ->join('products', 'items.product_id', '=', 'products.id')
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->where('carts.status', 1)
            ->groupBy('carts.id')
            ->get();
        //verifica as datas de entrega

        $abandoned = Cart::where('status', 2)->get();

        return view('pages.dashboard', compact('shops', 'abandoned'));
    }

    public function cartDetail($id)
    {

        $detail = Cart::where('id', $id)->first();

        $customer = User::where('id', $detail->user_id)->first();

        $items = Item::select(
            'products.name',
            'products.description',
            'products.reference',
            'products.delivery_days',
            'products.image',
            'prices.amount'
        )
            ->where('items.cart_id', $detail->id)
            ->join('products', 'products.id', '=', 'items.product_id')
            ->join('prices', 'prices.product_id', '=', 'products.id')
            ->where('prices.deleted_at', null)
            ->get();

        $total = 0;
        $deliveryCount = 0;
        //busca a data da entrega e faz o total da venda
        foreach ($items as $item) {
            if ($item->delivery_days > $deliveryCount)
                $deliveryCount = $item->delivery_days;

            $total = $total + $item->amount;
        }
        $deliveryDate = (Carbon::now())->addDays($deliveryCount);

        return view('pages.shop.details', compact(
            'detail',
            'customer',
            'items',
            'deliveryDate',
            'total'
        ));
    }
}
