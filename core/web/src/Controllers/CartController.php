<?php

namespace Web\Controllers;

use Cms\Constants;
use Cms\Models\Order;
use Cms\Models\OrderDetail;
use Cms\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Web\Controllers\AppController;
use Web\Helpers\Cart;
use Web\Helpers\CartItem;
use Web\Mails\OrderSuccessMail;
use Illuminate\Support\Facades\Mail;

class CartController extends AppController
{
    private $cart = null;

    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {

            $this->cart = Cart::getInstance();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $cart = $this->cart;

        $this->setSEO([
            'title' => trans('web::label.cart'),
            'url' => route('cart.index'),
        ]);

        return view('web::pages.cart.index', compact('cart'));
    }

    public function cartTop(Request $request)
    {
        return response()->json([
            'cart' => $this->cart->toArray(),
            'subtotal' => $this->cart->getSubTotalFormat(),
            'total' => $this->cart->getTotalFormat(),
        ]);
    }

    public function destroy()
    {
        $this->cart->destroy();
        return redirect()->route('cart.index');
    }

    public function addItem(Request $request)
    {
        $params = $request->only(['id', 'qty']);
        $product = Product::find($params['id']);
        $cartItem = new CartItem();
        $cartItem->setId($product->getKey());
        $cartItem->setName($product->getName());
        $cartItem->setImage(optional($product->imagesProduct()->first())->getSmallImage());
        if($product->discount) {
            $cartItem->setPrice($product->getOriginDiscountPrice());
        } else {
            $cartItem->setPrice($product->getOriginPrice());
        }
        
        $cartItem->setQty($params['qty']);
        $this->cart->addItem($cartItem);
        return response()->json($this->cart->toArray());
    }

    public function removeItem(Request $request)
    {
        $id = $request->id;
        $this->cart->removeItem($id);
        return response()->json([]);

    }

    public function update(Request $request)
    {
        $updateCart = $request->updateCart;
        foreach ($updateCart as $item) {
            $this->cart->updateCart($item['id'], $item['qty']);
        }
        return response()->json([]);

    }

    public function checkout(Request $request)
    {
        $cart = $this->cart;

        if ($request->isMethod('post')) {

            $validatedData = $request->validate([
                'customer_name' => 'required|max:255',
                'customer_email' => 'required|max:255',
                'customer_phone' => 'required|max:255',
                'customer_address' => 'required|max:255',
                'customer_note' => 'required|max:255',
                'customer_province' => 'required',
                'customer_district' => 'required',
                'customer_block' => 'required',
                'payment_method' => 'required',
            ], [
                'required' => 'Vui lòng nhập',
            ]);

            return DB::transaction(function () use ($validatedData, $cart) {
                $order = new Order();
                $order->customer_name = $validatedData['customer_name'];
                $order->customer_email = $validatedData['customer_email'];
                $order->customer_address = $validatedData['customer_address'];
                $order->customer_phone = $validatedData['customer_phone'];
                $order->customer_province = $validatedData['customer_province'];
                $order->customer_district = $validatedData['customer_district'];
                $order->customer_block = $validatedData['customer_block'];
                $order->payment_method = $validatedData['payment_method'];
                $order->status = Constants::ORDER_STATUS_NEW;
                $order->subtotal = $cart->getSubtotal();
                $order->total = $cart->getTotal();

                if ($order->save()) {

                    $orderDetails = [];
                    foreach ($cart->getCart() as $cartItem) {
                        $orderDetail = new OrderDetail();
                        $orderDetail->product_id = $cartItem->getId();
                        $orderDetail->name = $cartItem->getName();
                        $orderDetail->qty = $cartItem->getQty();
                        $orderDetail->price = $cartItem->getPrice();
                        $orderDetail->cost = $cartItem->getCost();
                        array_push($orderDetails, $orderDetail);
                    }

                    $order->orderDetails()->saveMany($orderDetails);

                }

                Mail::to($order->customer_email)->send(new OrderSuccessMail($order));

                $cart->destroy();

                return redirect()->route('cart.checkoutSuccess');

            });
        }

        $this->setSEO([
            'title' => trans('web::label.checkout'),
            'url' => route('cart.checkout'),
        ]);

        return view('web::pages.cart.checkout', compact('cart'));
    }

    public function checkoutSuccess(Request $request)
    {

        $this->setSEO([
            'title' => trans('web::label.checkout_success'),
            'url' => route('cart.checkoutSuccess'),
        ]);

        return view('web::pages.cart.checkout_success');
    }
}
