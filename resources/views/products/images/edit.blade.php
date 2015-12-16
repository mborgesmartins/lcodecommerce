@extends('app')
@section('content')

    <div class='container'>

        <h1>Altera Categegria {{ $category->name  }}</h1>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        @endif

        {!! Form::open(['route'=>['categories.update', $category->id], 'method'=>'put']) !!}

        <div class="form-group">

            {!! Form::label('name','Nome:') !!}
            {!! Form::text('name', $category->name, ['class'=>'form-control']) !!}

        </div>

        <!--description Text Field -->

        <div class="form-group">

            {!! Form::label('description','Descrição:') !!}
            {!! Form::textarea('description', $category->description, ['class'=>'form-control']) !!}

        </div>

        <!--Form submit button -->

        <div class="form-group">

            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}

        </div>

    </div>

@endsection