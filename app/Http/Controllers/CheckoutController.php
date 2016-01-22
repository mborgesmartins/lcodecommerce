<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Http\Requests;
use CodeCommerce\Order;
use CodeCommerce\OrderItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;


class CheckoutController extends Controller
{

    public function __construct() {

        $this->middleware('auth');
    }

    public function place_order(Order $orderModel,OrderItems $orderItems) {

        if (!Session::has('cart')) {
            return false;
        }

        $cart = Session::get('cart');
        $categories = Category::all();


        if ($cart->getTotal() > 0) {

            $order = $orderModel::create(['user_id' => 1, 'total' => $cart->getTotal()]);

            foreach ($cart->all() as $id => $item) {

                $order->items()->create(
                    [
                        'order_id' => $order->id,
                        'product_id' => $id,
                        'price' => $item['price'],
                        'qtd' => $item['qtd']
                    ]);
            }


            event( new CheckoutEvent($order, Auth::user()));
            $cart->clear();

            return view('checkout.place_order', ['order'=>$order, 'cart'=>'saved', 'categories'=>$categories]);
        }

        return view('checkout.place_order', ['cart'=>'empty', 'categories'=>$categories]);

    }

    public function test(CheckoutService $checkoutService ) {

/*
        $checkout = $checkoutService->createCheckoutBuilder()
            ->addItem(new Item(1, 'Televisão LED 500', 8999.99))
            ->addItem(new Item(2, 'Video-game mega ultra blaster', 799.99))
            ->getCheckout();

        $response = $checkoutService->checkout($checkout);

        return redirect($response->getRedirectionUrl());
*/

        return view("teste");
    }

}
