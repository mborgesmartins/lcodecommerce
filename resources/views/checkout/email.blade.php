
<h2> Caro Sr(a), {{ $user->name }}</h2>

<p>

    Seu pedido foi processado e aguarda confirmação da autorização de pagamento. <br><br>

    Pedido Número:{{ $order->id }} <br><br>
    Valor Total: {{ $order->total }} <br><br>
    Situação do Pedido: {{ $order->status_name }} <br><br>

</p>