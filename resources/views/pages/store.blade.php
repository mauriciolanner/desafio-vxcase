@extends('layouts.app')

@section('title', 'Novo produto')

@section('content')

@foreach ($products as $product)
<div class="col-md-3">
    <div class="card shadow-sm">
        <img width="253px" height="253px" src="{{asset($product->image)}}" alt="">
        <div class="card-body">
            <h4>{{$product->name}}</h4>
            <p class="card-text">
                {{$product->description}}
            </p>
            <h6>Entrega em {{$product->delivery_days}}</h6>
            <h5>R$ {{number_format($product->amount, 2, ',', '.')}}</h5>
            <small class="text-muted">{{$product->stock}} em estoque</small>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    @if(Auth::check())
                    <button type="button" onclick="addCart({{$product->id}}, {{$product->price_id}})"
                        class="btn btn-sm btn-outline-secondary"><i class="bi bi-cart-plus"></i> Colocar no
                        carrinho</button>
                    @else
                    <a href="/login" class="btn btn-sm btn-outline-secondary">Logar para comprar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="col-md-12 py-4">
    {{ $products->links("pagination::bootstrap-4") }}
</div>

@if(Auth::check())
<div class="panel panel-primary cart-flutuante">
    <div class="panel-heading">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-xs cart-btn" data-toggle="collapse" href="#cartCollapse">
                <i class="bi bi-cart4"></i>
            </button>
        </div>
    </div>
    <div class="panel-collapse collapse" id="cartCollapse">
        <div id="carts" class="cart-items">

        </div>
        <div class="total text-center">
            <h3 id="total">R$</h3>
        </div>
        <button onclick="finishCart()" class="finishCart">Finalizar compra</button>
    </div>
</div>

<div class="modal fade" id="finishCartModal" tabindex="-1" role="dialog" aria-labelledby="finishCartModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div><img width="400px" src="{{asset('images/cart.gif')}}" alt=""></div>
                <p>Compra finalizada com sucesso, em alguns dias seu produto está em sua casa</p>
            </div>
        </div>
    </div>
</div>
@endif
@stop

@section('script')

<script>
    function cartAll() {
    $.ajax({
        url: "/carrinho-api",
        async: true,
        type: 'get'
    }).done(function (data) {
        
        var total = 0
        for (var prop in data){
            total = parseFloat(total) + parseFloat(data[prop].amount)
            console.log(total)
        }        

        document.getElementById("carts").innerHTML = ''
        data.forEach(montahtml)
        document.getElementById("total").innerHTML = 'Total R$ ' + formatMoneyReal(total)

        $('#cartCollapse').collapse('show')

        function montahtml(cart) {
            var htmlcart = `
            <div class="panel-body row">
                <div class="col-md-3 cart-img">
                    <img src="{{asset('`+ cart.image + `')}}" alt="">
                </div>
                <div class="col-md-7">
                    <h1>`+ cart.name + `</h1>
                    <p>R$` + formatMoneyReal(cart.amount) + `</p>
                </div>
                <div class="col-md-2">
                    <button class="btn cart-delet" onclick="deletCart(` + cart.item_id + `)">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            </div>
            `;
            document.getElementById("carts").innerHTML += htmlcart;
        }

    }).fail(function (jqXHR, textStatus, msg) {
    });
}

$(document).ready(function () {
    cartAll();
})

function addCart(product_id, price_id) {
    $.ajax({
        url: "/add-carrinho",
        type: 'post',
        data: {
            product_id: product_id,
            price_id: price_id,
            _token: "{{ csrf_token() }}",
        },
        beforeSend: function () {
            //
        }
    }).done(function (msg) {
        cartAll()
    })
    .fail(function (jqXHR, textStatus, msg) {
        console.log(msg);
    });
}

function deletCart(item_id) {
    $.ajax({
        url: "/deleta-carrinho",
        type: 'post',
        data: {
            item_id: item_id,
            _token: "{{ csrf_token() }}",
        },
        beforeSend: function () {
            //
        }
    }).done(function (msg) {
        cartAll()
    })
    .fail(function (jqXHR, textStatus, msg) {
        console.log(msg);
    });
}

function finishCart(){
    $.ajax({
        url: "/finaliza-carrinho",
        type: 'get',
        async: true,
        beforeSend: function () {
            //
        }
    }).done(function (msg) {
        cartAll()
        $('#finishCartModal').modal('show')
    })
    .fail(function (jqXHR, textStatus, msg) {
        console.log(msg);
    });
}

function formatMoneyReal(n, c, d, t) {
  c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

</script>
@endsection