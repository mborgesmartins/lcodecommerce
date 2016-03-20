<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Http\Requests;
use CodeCommerce\Order;
use CodeCommerce\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Purchases\Subscriptions\Locator;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;


class CheckoutController extends Controller
{

    public function __construct() {

        //$this->middleware('auth');
    }

    public function place_order(Order $orderModel,OrderItems $orderItems, CheckoutService $checkoutService) {

        if (!Session::has('cart')) {
            return false;
        }

        $cart = Session::get('cart');
        $categories = Category::all();


        if ($cart->getTotal() > 0) {

            $order = $orderModel::create(['user_id' => Auth::User()->id, 'total' => $cart->getTotal(),'status' => '0']);

            foreach ($cart->all() as $id => $item) {

                $order->items()->create(
                    [
                        'order_id' => $order->id,
                        'product_id' => $id,
                        'price' => $item['price'],
                        'qtd' => $item['qtd']
                    ]);
            }

            $checkout = $checkoutService->createCheckoutBuilder();
            $checkout->setReference($order->id);

            foreach($order->items as $order_item)

                $checkout->addItem(new Item($order_item->product_id,
                            $order_item->product->name,
                            $order_item->price)
                    );


            $response = $checkoutService->checkout($checkout->getCheckout());

            $order->update(['payment_code'=>$response->getCode()]);
            event( new CheckoutEvent($order, Auth::user()));
            $cart->clear();

            return redirect($response->getRedirectionUrl());
            //return view('checkout.place_order', ['order'=>$order, 'cart'=>'saved', 'categories'=>$categories]);
        }

        return view('checkout.place_order', ['cart'=>'empty', 'categories'=>$categories]);

    }

    public function retorno (Request $request, \PHPSC\PagSeguro\Purchases\Transactions\Locator $locator, Order $orderModel) {

        $transaction_code = $request->get('transaction_id');

        $transaction = $locator->getByCode($transaction_code);

        $status = $transaction->getDetails()->getStatus();
        $code = $transaction->getDetails()->getCode();
        $order_id = $transaction->getDetails()->getReference();

        $order = $orderModel->find($order_id);
        $order->update(['status'=>$status, 'payment_code'=>$code]);

        return redirect()->route('admin.orders');

    }

    public function status_change (Request $request, Locator $locator, Order $orderModel)
    {

        return "ok";


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
