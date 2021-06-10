<?php

namespace Cms\Controllers;

use Cms\Controllers\AppController;
use Cms\Models\Block;
use Cms\Models\City;
use Cms\Models\District;
use Cms\Models\Order;
use Illuminate\Http\Request;

class OrderController extends AppController
{

    public function save(Request $request, Order $order)
    {
        if ($request->isMethod('post')) {

            $order->customer_name = $request->input('customer_name');
            $order->customer_email = $request->input('customer_email');
            $order->customer_address = $request->input('customer_address');
            $order->customer_phone = $request->input('customer_phone');
            $order->customer_province = $request->input('customer_province');
            $order->customer_district = $request->input('customer_district');
            $order->customer_block = $request->input('customer_block');
            $order->payment_method = $request->input('payment_method');
            $order->status = $request->input('status');
            $order->save();

            if ($order->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.order.list')->with('success', $message);
        }

        if ($order->exists) {
            $cities = City::query()->select('matp', 'name')->get();
            $districts = District::query()->select('maqh', 'name')->where('matp', $order->customer_province)->get();
            $blocks = Block::query()->select('xaid', 'name')->where('maqh', $order->customer_district)->get();
        }

        return view('cms::auth.pages.order.form', compact('order', 'cities', 'districts', 'blocks'));
    }
}
