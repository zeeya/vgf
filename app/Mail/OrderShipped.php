<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Return_request;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $return_request;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Return_request $return_request)
    {
        $this->return_request = $return_request;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.Return_mail');
        // return $this->from('example@example.com')
        // ->view('emails.orders.shipped');
    }
}
