<?php

namespace Cms\Controllers;

use Cms\Controllers\AppController;
use Cms\Models\Block;
use Cms\Models\City;
use Cms\Models\District;
use Cms\Models\Order;
use Cms\Models\OrderDetail;
use Cms\Requests\OrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends AppController
{

    public function save(OrderRequest $request, Order $order)
    {
        if ($request->isMethod('post')) {

            return DB::transaction(function () use($request, $order) {
                $order_details = null;
                if (!$order->exists) {
                    $order->customer_name = $request->input('customer_name');
                    $order->customer_email = $request->input('customer_email');
                    $order->customer_address = $request->input('customer_address');
                    $order->customer_phone = $request->input('customer_phone');
                    $order->customer_province = $request->input('customer_province');
                    $order->customer_district = $request->input('customer_district');
                    $order->customer_block = $request->input('customer_block');
                    $order->payment_method = $request->input('payment_method');
                    $order->status = $request->input('status');
                    $order_details = json_decode($request->input('order_details'), true);
                    $order->subtotal = $order_details['subtotal'];
                    $order->total = $order_details['total'];


                } else {
                    $order->status = $request->input('status');
                }

                if ($order->save()) {

                    if (!is_null($order_details)) {
                        $orderDetails = [];
                        foreach ($order_details['details'] as $order_detail) {
                            $orderDetail = new OrderDetail();
                            $orderDetail->product_id = $order_detail['id'];
                            $orderDetail->name = $order_detail['name'];
                            $orderDetail->qty = $order_detail['qty'];
                            $orderDetail->price = $order_detail['price'];
                            $orderDetail->cost = $order_detail['cost'];
                            array_push($orderDetails, $orderDetail);
                        }

                        $order->orderDetails()->saveMany($orderDetails);

                    }
                }

                if ($order->exists) {
                    $message = trans('cms::auth.message.update_success');
                } else {
                    $message = trans('cms::auth.message.create_success');
                }

                return redirect()->route('auth.order.list')->with('success', $message);

            });
        }

        $cities = City::query()->select('matp', 'name')->get();
        $districts = District::query()->select('maqh', 'name')->where('matp', $order->customer_province)->get();
        $blocks = Block::query()->select('xaid', 'name')->where('maqh', $order->customer_district)->get();

        return view('cms::auth.pages.order.form', compact('order', 'cities', 'districts', 'blocks'));
    }

    public function print(Request $request, Order $order)
    {
        return view('cms::auth.pages.order.print', compact('order'));
    }

    public function remove(Request $request)
    {
        $ids = $request->has('ids') ? $request->ids : [$request->user];
        Order::query()->whereIn('id', $ids)->delete();
        OrderDetail::query()->whereIn('order_id', $ids)->delete();

        $message = trans('cms::auth.message.remove_success');

        return response()->json(['success' => $message]);
    }
}
