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
                                    R$ <span  id="{{"price_" . $id}}">{{ $item['price'] }}</span>

                                </td>
                                <td class="cart_qty">
                                    <button type="button" class="chg_qty" id="{{"inc_qty" . $id}}">+</button>
                                    <span id="{{ "qty_" . $id }}">{{ $item['qtd'] }}</span>
                                    <button type="button" class="chg_qty" id="{{"dec_qty" . $id}}">-</button>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price" id="{{"total_" . $id}}"> {{ $item['price'] * $item['qtd']}}</p>

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
                                        TOTAL: R$ <span id="total_geral"> {{ $cart->getTotal()  }} </span>
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

@endsection

@section('script')

    <script type="text/javascript">

        $( document ).ready(function() {

            $(".chg_qty").click(function (event) {

                // identifica se é incremento ou decremento
                inc = 0;
                sinal = $('#'+this.id).text();

                // recupera id da linha
                if (sinal == '+')
                    id = (this.id).replace('inc_qty','');
                else
                    id = (this.id).replace('dec_qty','');

                // recupera id da quantidade
                qty_id = '#qty_' + id;

                // obtem a quantidade
                qty = parseInt($(qty_id).text().replace('qty_', ''));

                // calcula o incremento ou decremento
                if (sinal == '+') inc = 1; else { if (qty > 1) inc = -1 }

                // opbtem preço
                price = parseInt($("#price_" + id ).text());

                // calcula total da linha atual
                total = qty * price;

                // calcula total geral menos total atual
                total_geral = parseInt($("#total_geral").text());


                // retira do total geral total atual
                total_geral = total_geral - total;

                // incrementa / decrementa total
                qty += inc;

                // atualiza quantidade na tela
                $(qty_id).text(qty);

                // calcula novo total
                total = qty * price;
                $('#total_'+id).text(total);

                // atualiza total geral
                total_geral = total_geral + total;
                $("#total_geral").text(total_geral)

                // monta url para atualizar session
                url = '/store/cart/update_qty/' + id + '/' + $(qty_id).text();

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {} ,
                    success: function (result) {
                        // use it here
                        //sessionData = result.sessionData
                    }
                });
            });

        });

    </script>

@endsection


