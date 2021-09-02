<?php

namespace Web\Controllers;

use Cms\Models\Post;
use Cms\Models\Order;
use Illuminate\Http\Request;
use Web\Controllers\AppController;
use Illuminate\Support\Facades\Mail;
use Web\Mails\OrderSuccessMail;

class TestController extends AppController
{
    public function testMail()
    {
        $order = Order::first();
        $order->hotline = $this->config->phone1;
        Mail::to("thaivuong1503@gmail.com")->send(new OrderSuccessMail($order));
        echo 'test-mail';
    }
}
