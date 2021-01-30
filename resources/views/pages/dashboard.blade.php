@extends('layouts.app')

@section('title', 'Dasboard')

@section('content')
<div class="col-md-3">
    <div class="card">
        <div class="card-header">total das vendas</div>

        <div class="card-body text-center">
            <h1>R$ 150,00</h1>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card">
        <div class="card-header">total entregas</div>

        <div class="card-body text-center">
            <h1>{{count($shops)}}</h1>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">Vendas realizadas</div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Pedido</th>
                        <th scope="col">Cliente</th>
                        <th scope="col" class="text-right">Opções e prazos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shops as $shop)
                    <tr>
                        <th scope="row">{{$shop->id}}</th>
                        <td>{{$shop->name}}</td>
                        <td class="text-right">
                            <a href="/pedido/detalhes/{{$shop->id}}" class="btn btn-outline-success">Ver detalhes</a>
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#editProduct">
                                Marcar Entregue
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection