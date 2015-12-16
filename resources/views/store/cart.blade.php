@extends('store.store')

@section('content')
    <section id="cart_items">

        <div class="container">

            <div class="table-responsive cart_info" >

                <table class="table table-condensed">

                    <thead>
                        <tr class="cart_menu">

                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Preço</td>
                            <td class="qty">Quantidade</td>
                            <td class="total">Total</td>
                            <td></td>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cart->all() as $id=>$item)
                            <tr>
                                <td class="cart_product">
                                    <a href="{{ route('store.product',['id'=>$id])  }}">
                                        <img src="{{ url($item['image'])}}" alt=""  width="100" />
                                    </a>
                                </td>

                                <td class="cart_description">
                                    <a href="{{ route('store.product',['id'=>$id])  }}"><h4> {{ $item['name'] }}</h4></a>
                                    <p>Código: {{ $id  }}</p>

                                </td>
                                <td class="cart_price">
                                    R$ {{ $item['price'] }}

                                </td>
                                <td class="cart_qty">
                                    {{ $item['qtd'] }}

                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price"> {{ $item['price'] * $item['qtd']}}</p>

                                </td>
                                <td class="cart_delete">
                                    <a href="{{ route('store.cart.destroy',['id'=>$id]) }}" class="cart_item_delete">Excluir</a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td class="cart_product" colspan="6">Carrinho vazio</td>
                            </tr>
                        @endforelse

                        <tr class="cart_menu">
                            <td colspan="6">
                                <div class="pull-right">
                                    <span style="margin-right: 80px">
                                        TOTAL: R$ {{ $cart->getTotal()  }}
                                    </span>
                                    <a href="{{ route('checkout.place.order') }}" class="btn btn-success">Fechar o Pedido</a>
                                </div>
                            </td>
                        </tr>


                    </tbody>



                </table>

            </div>

        </div>

    </section>
@stop