@extends('app')
    @section('content')

    <div class='container'>

        <h1>Produtos</h1>

        <a href="{{ route('products.create')  }}" class="btn btn-default">Novo</a>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>ação</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <a href="{{ route('products.destroy', ['id'=>$product->id]) }}">Excluir</a>|
                        <a href="{{ route('products.images', ['id'=>$product->id]) }}">Images</a>|
                        <a href="{{ route('products.edit', ['id'=>$product->id]) }}">Alterar</a>
                    </td>
                </tr>
            @endforeach

        </table>


    </div>

    @endsection