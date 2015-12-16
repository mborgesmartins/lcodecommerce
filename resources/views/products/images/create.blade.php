@extends('app')
@section('content')

    <div class='container'>

        <h1>Nova Imagem do Produto {{ $product->id }}</h1>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        @endif

        {!! Form::open(['route'=>['products.images.store',$product->id], 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}

        <div class="form-group">

            {!! Form::label('image','Arquivo Imagem:') !!}
            {!! Form::file('image', null, ['class'=>'field-control']) !!}

        </div>


        <!--Form submit button -->

        <div class="form-group">

            {!! Form::submit('Upload', ['class'=>'btn btn-primary field-control']) !!}

        </div>

    </div>

@endsection