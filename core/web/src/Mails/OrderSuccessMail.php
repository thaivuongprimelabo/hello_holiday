<?php
namespace Web\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Cms\Models\Config;

class OrderSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $config = Config::first();
        $this->order = $order;
        $this->order->web_name = $config->web_title;
        $this->order->company_email = $config->company_email;
        $this->order->hotline = $config->phone1;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->order->company_email, $this->order->web_name)
            ->subject('Xác nhận đặt hàng')
            ->view('web::mails.order_success');
    }
}
