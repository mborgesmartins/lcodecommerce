@extends('app')
@section('content')

    <div class='container'>

        <h1>Altera Produto {{ $product->name  }}</h1>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        @endif

        {!! Form::open(['route'=>['products.update', $product->id], 'method'=>'put']) !!}

        <div class="form-group">

            {!! Form::label('category_id','Categoria:') !!}
            {!! Form::select('category_id', $categories, $product->category_id,  ['class'=>'form-control']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('name','Nome:') !!}
            {!! Form::text('name', $product->name, ['class'=>'form-control']) !!}

        </div>

        <!--description Text Field -->

        <div class="form-group">

            {!! Form::label('description','Descrição:') !!}
            {!! Form::textarea('description', $product->description, ['class'=>'form-control']) !!}

        </div>

        <!--price Text Field -->

        <div class="form-group">

            {!! Form::label('price','Preço:') !!}
            {!! Form::number('price', $product->price, ['class'=>'form-control']) !!}

        </div>

        <!--featured Text Field -->

        <div class="form-group">

            {!! Form::label('featured','Destaque:') !!}
            {!! Form::checkbox('featured', $product->featured, ['class'=>'form-control']) !!}

        </div>

        <!--featured Text Field -->

        <div class="form-group">

            {!! Form::label('recommended','Recomendado:') !!}
            {!! Form::checkbox('recommended', $product->recommended, ['class'=>'form-control']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('tags','Tags(lista de valores entre vírgulas):') !!}
            {!! Form::text('tags', $tags, ['class'=>'form-control']) !!}

        </div>

        <!--Form submit button -->

        <div class="form-group">

            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}

        </div>

    </div>

@endsection