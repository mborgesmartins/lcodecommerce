<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Cart;
use CodeCommerce\Http\Requests;
use CodeCommerce\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    private $cart;

    /**
     * @param Cart $cart
     */
    public function __construct(Cart $cart) {


        $this->cart = $cart;

    }

    public function index() {

        if (!Session::has('cart')) {

            Session::set('cart', $this->cart);

        }

        return view('store.cart', ['cart'=>Session::get('cart')]);

    }

    public function add($id) {

        $cart = $this->getCart();

        $product = Product::find($id);

        $image = ($product->images->first()) ?
            'uploads' . '/' . $product->images->first()->id . '.' . $product->images->first()->extension :
            'images/no-img.jpg';


        $cart->add($id, $product->name, $product->price, $image);

        Session::set('cart', $cart);

        return redirect()->route('store.cart');

    }

    public function destroy($id) {

        $cart = $this->getCart();

        $cart->remove($id);

        Session::set('cart', $cart);

        return redirect()->route('store.cart');


    }
    /**
     * @return Cart
     */
    public function getCart()
    {
        if (Session::has('cart'))

            $cart = Session::get('cart');

        else

            $cart = $this->cart;

        return $cart;
    }

    /**
     * @return Cart
     */
    public function update_qty($id, $qty)
    {
        if (Session::has('cart'))

            $cart = Session::get('cart');

        else

            $cart = $this->cart;

        $conta = 0;


        $cart->update_qty($id, $qty);

        //dd($cart);

        Session::set('cart', $cart);

        return "Cart Atualizado com sucesso";
    }
}
