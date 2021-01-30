@extends('layouts.app')

@section('title', 'Detalhes do produto')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{$product->name}}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img width="450px" src="{{asset($product->image)}}" alt="">
                </div>
                <div class="col-md-6">
                    <p>
                        <strong>Detalhes: </strong>{{$product->description}}
                    </p>
                    <p>
                        <strong>Estoque: </strong>{{$product->stock}}
                    </p>
                    <p>
                        <strong>Tempo para entrega: </strong>{{$product->delivery_days}}
                    </p>
                    <p>
                        <strong>Preço atual: </strong>{{number_format($product->amount, 2, ',', '.')}}
                    </p>
                    <p>
                        <strong>Preços antigos: </strong>
                    </p>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Valor</th>
                        <th scope="col">Data de inicio</th>
                        <th scope="col">Data fim</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pricesOld as $price)
                    <tr>
                        <th scope="col">{{$price->amount}}</th>
                        <th scope="col">{{$price->created_at}}</th>
                        <th scope="col">{{$price->deleted_at}}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection