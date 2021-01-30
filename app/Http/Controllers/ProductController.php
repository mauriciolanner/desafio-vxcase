<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Price;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Session;
use App\VXCase\Functions;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function __construct(Functions $functions)
    {
        $this->middleware('auth');
        $this->functions = $functions;
    }

    public function index(SearchRequest $request)
    {
        $search = $request->input('q');

        if ($search != "") {

            $products = Product::where(function ($query) use ($search) {
                $query->where('products.code', 'like', '%' . $search . '%')
                    ->orWhere('products.name', 'like', '%' . $search . '%');
            })->select(
                'products.id',
                'products.name',
                'products.description',
                'products.stock',
                'products.delivery_days',
                'products.reference',
                'products.image',
                'prices.amount'
            )->leftJoin('prices', 'prices.product_id', '=', 'products.id')
                ->where('prices.deleted_at', null)
                ->paginate(10);

            $products->appends(['q' => $search]);
        } else {
            $products = Product::select(
                'products.id',
                'products.name',
                'products.description',
                'products.stock',
                'products.delivery_days',
                'products.reference',
                'products.image',
                'prices.amount'
            )->leftJoin('prices', 'prices.product_id', '=', 'products.id')
                ->where('prices.deleted_at', null)
                ->paginate(10);
        }

        return view('pages.product.index', compact('products'));
    }

    public function new()
    {
        return view('pages.product.new');
    }

    public function store(ProductRequest $request)
    {
        //verificação se enviou uma imagem
        if ($request->image == null) {

            $image = '/images/sample_product.png';
        } else {
            //validação da imagem e upload
            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                $name = md5(date('HisYmd'));
                $extension = $request->image->extension();
                $nameFile = "{$name}.{$extension}";
                $upload = $request->image->storeAs('products', $nameFile);
                $image = 'storage/products/' . $nameFile;

                if (!$upload) {
                    Session::flash('error', "Erro ao fazer o upload do arquivo");
                    return redirect()->back()->withInput();
                }
            }
        }

        //insere o produto no banco de dados
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'delivery_days' => $request->delivery_days,
            'reference' => $request->reference,
            'stock' => $request->stock,
            'image' => $image
        ]);

        //insere o preço no banco
        $price = Price::create([
            'amount' => $this->functions->convertValue($request->amount),
            'product_id' => $product->id
        ]);

        Session::flash('success', "Produto cadastrado com sucesso!");

        return redirect()->route('produtos');
    }

    function edit(ProductRequest $request)
    {
        $editProduct = Product::find($request->product_id);
        $editProduct->name = $request->name;
        $editProduct->description = $request->description;
        $editProduct->stock = $request->stock;
        $editProduct->delivery_days = $request->delivery_days;
        $editProduct->reference = $request->reference;

        //verifica se precisa torcar a imagem
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $name = md5(date('HisYmd'));
            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";
            $upload = $request->image->storeAs('products', $nameFile);
            $image = 'storage/products/' . $nameFile;
            $editProduct->image = $image;
            if (!$upload) {
                Session::flash('error', "Erro ao fazer o upload do arquivo");
                return redirect()->back()->withInput();
            }
        }

        //verifica se precisa alterar o preço
        $amount = Price::where('product_id', $request->product_id)->first();
        if ($amount->amount != $this->functions->convertValue($request->amount)) {
            $oldAmount = Price::find($amount->id);
            $oldAmount->deleted_at = Carbon::now();
            $oldAmount->save();

            $newAmount = Price::create([
                'product_id' => $request->product_id,
                'amount' => $this->functions->convertValue($request->amount)
            ]);
        }

        $editProduct->save();

        Session::flash('success', "Produto editado com sucesso!");

        return back();
    }

    public function details($id)
    {
        $product = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.stock',
            'products.delivery_days',
            'products.reference',
            'products.image',
            'prices.amount'
        )
            ->where('products.id', $id)
            ->join('prices', 'product_id', '=', 'products.id')
            ->where('prices.deleted_at', null)
            ->first();

        $pricesOld = Price::where('product_id', $id)->withTrashed()->get();

        return view('pages.product.details', compact('product', 'pricesOld'));
    }

    public function delet(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        $delet = Product::find($request->id);
        $delet->deleted_at = Carbon::now();
        $delet->save();

        Session::flash('success', "Produto deletado com sucesso!");

        return back();
    }
}
