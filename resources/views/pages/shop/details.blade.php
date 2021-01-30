@extends('layouts.app')

@section('title', 'Detalhes das vendas')

@section('content')

<div class="col-md-3">
    <div class="card">
        <div class="card-header">Entregar até</div>
        <div class="card-body">
            <h3>{{$deliveryDate->format('d/m/Y')}}</h3>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card">
        <div class="card-header">Total da venda</div>
        <div class="card-body">
            <h3>R$ {{number_format($total, 2, ',', '.')}}</h3>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Detalhes do cliente</div>
        <div class="card-body">
            <p>
                <strong>Cliente: </strong> {{$customer->name}}<br>
                <strong>Email: </strong> {{$customer->email}}
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Detalhes do cliente</div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Imagem</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Preço</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <th>{{$item->reference}}</th>
                        <td class="image-product"><img src="{{asset($item->image)}}" alt=""></td>
                        <td>{{$item->name}}</td>
                        <td>R$ {{number_format($item->amount, 2, ',', '.')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection