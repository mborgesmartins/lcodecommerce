@extends('app')
@section('content')

    <div class='container'>

        <h1>Novo Produto</h1>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        @endif

        {!! Form::open(['route'=>'products.store']) !!}

        <div class="form-group">

            {!! Form::label('category_id','Categoria:') !!}
            {!! Form::select('category_id', $categories, null,  ['class'=>'form-control']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('name','Nome:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}

        </div>

        <!--description Text Field -->

        <div class="form-group">

            {!! Form::label('description','Descrição:') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}

        </div>

        <!--price Text Field -->

        <div class="form-group">

            {!! Form::label('price','Preço:') !!}
            {!! Form::number('price', null, ['class'=>'form-control']) !!}

        </div>

        <div class="form-group">

            {!! Form::hidden('featured', false) !!}
            {!! Form::label('featured','Destaque:') !!}
            {!! Form::checkbox('featured', true, null, ['class'=>'field-control']) !!}

        </div>

        <!--featured Text Field -->

        <div class="form-group">

            {!! Form::hidden('recommended', false) !!}
            {!! Form::label('recommended','Recomendado:') !!}
            {!! Form::checkbox('recommended', true,  null, ['class'=>'field-control']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('tags','Tags(lista de valores entre vírgulas):') !!}
            {!! Form::text('tags', null, ['class'=>'form-control']) !!}

        </div>

        <!--Form submit button -->

        <div class="form-group">

            {!! Form::submit('Salvar', ['class'=>'btn btn-primary field-control']) !!}

        </div>

    </div>

@endsection