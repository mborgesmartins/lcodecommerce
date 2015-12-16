@extends('app')
    @section('content')

    <div class='container'>

        <h1>Imagens do Produto {{ $product->name }}</h1>

        <a href="{{ route('products.images.create', ['id'=>$product->id])  }}" class="btn btn-default">Novo</a>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Extensão</th>
                <th>Imagem</th>
                <th>ação</th>
            </tr>
            @foreach($product->images as $productimage)
                <tr>
                    <td>{{ $productimage->id }}</td>
                    <td>{{ $productimage->extension }}</td>
                    <td><img src="{{ url('uploads/' . $productimage->id . '.' . $productimage->extension) }}"</td>
                    <td>
                        <a href="{{ route('products.images.destroy', ['id'=>$productimage->id]) }}">Excluir</a>
                    </td>
                </tr>
            @endforeach

        </table>
        <a href="{{ route('products')  }}" class="btn btn-default">Voltar</a>


    </div>

    @endsection