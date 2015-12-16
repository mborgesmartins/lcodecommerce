@extends('store.store')

@section('content')
    <section id="cart_items">

        <div class="container">

            <div class="table-responsive cart_info" >

                <table class="table table-condensed">

                    <thead>
                        <tr class="cart_menu">

                            <td class="id">ID</td>
                            <td class="itens">Itens</td>
                            <td class="total">Total</td>
                            <td class="status">Status</td>

                        </tr>
                    </thead>

                    <tbody>

                        @forelse($orders->all() as $order)

                            <tr>
                                <td class="cart_id">{{ $order->id }}</td>
                                <td class="cart_itens">
                                    <ul>
                                        @forelse($order->items as $item)
                                            <li>{{$item->product->name}}</li>
                                        @empty
                                            <li>Sem itens</li>
                                        @endforelse
                                    </ul>
                                </td>
                                <td class="cart_total">{{ $order->total}}</td>
                                <td class="cart_status">{{ $order->status}}</td>
                            </tr>

                        @empty
                            <tr>
                                <td class="cart_product" colspan="4">
                                    <h2>Não há pedidos cadastrados</h2>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </section>

@stop