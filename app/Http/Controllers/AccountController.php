<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Http\Requests;
use CodeCommerce\Order;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //

    public function orders() {

        $orders = Auth::user()->orders;

        return view('account.orders', compact('orders'));

    }

    public function edit_status_order($id, Order $OrderModel) {

        $order = $OrderModel::find($id);

        $order_status_types = $order->getStatusTypes();

        return view('account.edit_status_order', compact('order', 'order_status_types'));

    }

    public function save_status_order(Request $request, Order $OrderModel) {

        $id = $request->get('id');
        $order = $OrderModel::find($id);

        $status = $request->get('status');

        $order->update(['status'=>$status]);

        return redirect()->route('account.orders');


    }

}
