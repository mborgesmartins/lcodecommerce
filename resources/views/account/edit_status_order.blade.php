@extends('app')

@section('content')

    <div class='container'>

        <h1>Altera Status Pedido {{ $order->id  }}</h1>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        @endif

        {!! Form::open(['route'=>['account.save_status_order'], 'method'=>'put']) !!}

        {!! Form::hidden('id', $order->id) !!}

        <div class="form-group">

            {!! Form::label('status','Status:') !!}
            {!! Form::select('status', $order_status_types, $order->status,  ['class'=>'form-control']) !!}

        </div>

        <!--Form submit button -->

        <div class="form-group">

            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}

        </div>

        {!! Form::close() !!}

    </div>

@endsection