@extends('store.store')

@section('categories')
    @include('store.partial.categories')
@stop

@section('content')
    <div class="container">

        @if($cart == 'empty')
            <h2>Carrinho não possui produtos.</h2>
        @else
            <h2>O Pedido foi gravado com sucesso.</h2>
        @endif

    </div>
@stop