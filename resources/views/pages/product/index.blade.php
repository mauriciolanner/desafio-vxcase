@extends('layouts.app')

@section('title', 'Produtos')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">Todos Produtos</div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Imagem</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Estoque</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <th>{{$product->reference}}</th>
                        <td class="image-product"><img src="{{asset($product->image)}}" alt=""></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->stock}}</td>
                        <td>R$ {{number_format($product->amount, 2, ',', '.')}}</td>
                        <td>
                            <a href="/produto/detalhes/{{$product->id}}" class="btn btn-outline-success">ver</a>
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#editProduct{{$product->id}}">
                                Editar
                            </button>
                            <button type="submit" form="deletProduct{{$product->id}}" class="btn btn-outline-warning">Deletar</button>
                            <form id="deletProduct{{$product->id}}" method="POST" action="{{route('deletaproduto')}}">
                                @csrf
                                <input name="id" value="{{$product->id}}" type="hidden">
                            </form>
                        </td>
                    </tr>

                    <!-- Modal edit -->
                    <div class="modal fade bd-example-modal-lg" id="editProduct{{$product->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="editProduct{{$product->id}}Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProduct{{$product->id}}Label">Edição do produto
                                        {{$product->name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="formEdit{{$product->id}}" action="{{route('editarproduto')}}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <div class="form-group row">
                                            <label for="name"
                                                class="col-md-2 col-form-label text-md-right">Nome*</label>
                                            <div class="col-md-8">
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{$product->name}}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="amount"
                                                class="col-md-2 col-form-label text-md-right">Preço*</label>
                                            <div class="col-md-8">
                                                <input id="amount" type="text"
                                                    class="form-control real @error('amount') is-invalid @enderror"
                                                    name="amount" value="{{$product->amount}}" required
                                                    autocomplete="amount" autofocus>

                                                @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description"
                                                class="col-md-2 col-form-label text-md-right">Descrição</label>

                                            <div class="col-md-8">
                                                <textarea id="description"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    name="description">{{$product->description}}</textarea>

                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="delivery_days"
                                                class="col-md-2 col-form-label text-md-right">Dias para a
                                                entrega*</label>

                                            <div class="col-md-8">
                                                <input id="delivery_days" type="number"
                                                    class="form-control @error('delivery_days') is-invalid @enderror"
                                                    name="delivery_days" value="{{$product->delivery_days}}" required
                                                    autocomplete="delivery_days" autofocus>

                                                @error('delivery_days')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="stock"
                                                class="col-md-2 col-form-label text-md-right">Estoque*</label>

                                            <div class="col-md-8">
                                                <input id="stock" type="number"
                                                    class="form-control @error('stock') is-invalid @enderror"
                                                    name="stock" value="{{$product->stock}}" required
                                                    autocomplete="stock" autofocus>

                                                @error('stock')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="reference"
                                                class="col-md-2 col-form-label text-md-right">Referência*</label>

                                            <div class="col-md-8">
                                                <input id="reference" type="text"
                                                    class="form-control @error('reference') is-invalid @enderror"
                                                    name="reference" value="{{$product->reference}}" required
                                                    autocomplete="reference" autofocus>

                                                @error('reference')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="image"
                                                class="col-md-2 col-form-label text-md-right">Imagem</label>

                                            <div class="col-md-8">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image"
                                                        id="image">
                                                    <label class="custom-file-label" for="image">Escolha o
                                                        arquivo</label>
                                                </div>

                                                @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p>(*) Campos obrigatórios</p>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" form="formEdit{{$product->id}}"
                                        class="btn btn-primary">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
            {{ $products->links("pagination::bootstrap-4") }}
        </div>
    </div>
</div>

@stop

@section('script')

<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script src="{{asset('js/mask.js')}}"></script>

@endsection