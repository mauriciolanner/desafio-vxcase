@extends('layouts.app')

@section('title', 'Novo produto')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>Cadastrar produto</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{route('criaproduto')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-md-right">Nome*</label>
                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="amount" class="col-md-2 col-form-label text-md-right">Preço*</label>
                    <div class="col-md-8">
                        <input id="amount" type="text" class="form-control real @error('amount') is-invalid @enderror"
                            name="amount" value="{{ old('amount') }}" required autocomplete="amount" autofocus>

                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label text-md-right">Descrição</label>

                    <div class="col-md-8">
                        <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                            name="description">{{ old('description') }}</textarea>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="delivery_days" class="col-md-2 col-form-label text-md-right">Dias para a
                        entrega*</label>

                    <div class="col-md-8">
                        <input id="delivery_days" type="number"
                            class="form-control @error('delivery_days') is-invalid @enderror" name="delivery_days"
                            value="{{ old('delivery_days') }}" required autocomplete="delivery_days" autofocus>

                        @error('delivery_days')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="stock" class="col-md-2 col-form-label text-md-right">Estoque*</label>

                    <div class="col-md-8">
                        <input id="stock" type="number"
                            class="form-control @error('stock') is-invalid @enderror" name="stock"
                            value="{{ old('stock') }}" required autocomplete="stock" autofocus>

                        @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="reference" class="col-md-2 col-form-label text-md-right">Referência*</label>

                    <div class="col-md-8">
                        <input id="reference" type="text" class="form-control @error('reference') is-invalid @enderror"
                            name="reference" value="{{ old('reference') }}" required autocomplete="reference" autofocus>

                        @error('reference')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-md-2 col-form-label text-md-right">Imagem</label>

                    <div class="col-md-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image">
                            <label class="custom-file-label" for="image">Escolha o arquivo</label>
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
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('script')

<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script src="{{asset('js/mask.js')}}"></script>

@endsection