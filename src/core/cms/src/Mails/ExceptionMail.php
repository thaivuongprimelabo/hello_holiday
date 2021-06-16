<?php
namespace Cms\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExceptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $exception;

    public $from = [
        ['name' => 'Administrator', 'address' => 'thaivuong1503@gmail.com']
    ];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(config('app.url') . ': ' . $this->exception->getMessage())
            ->view('cms::auth.mail.exception');
    }
}
