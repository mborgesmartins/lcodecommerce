@extends('app')
    @section('content')

    <div class='container'>

        <h1>Categorias</h1>

        <a href="{{ route('categories.create')  }}" class="btn btn-default">Novo</a>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>ação</th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('categories.destroy', ['id'=>$category->id]) }}">Excluir</a>|
                        <a href="{{ route('categories.edit', ['id'=>$category->id]) }}">Alterar</a>
                    </td>
                </tr>
            @endforeach

        </table>

        {!! $categories->render() !!}

    </div>

    @endsection