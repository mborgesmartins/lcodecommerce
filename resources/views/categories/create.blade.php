@extends('app')

@section('content')

    <div class='container'>

        <h1>Nova Categoria</h1>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        @endif

        {!! Form::open(['route'=>'categories.store']) !!}

        <div class="form-group">

            {!! Form::label('name','Nome:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}

        </div>

        <!--description Text Field -->

        <div class="form-group">

            {!! Form::label('description','Descrição:') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}

        </div>

        <!--Form submit button -->

        <div class="form-group">

            {!! Form::submit('Salvar', ['class'=>'btn btn-primary form-control']) !!}

        </div>

    </div>

@endsection