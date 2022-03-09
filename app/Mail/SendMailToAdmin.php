<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $restaurant_id;
    private $order;
    public function __construct($data)
    {
        $this->order = $data;
        $this->restaurant_id = $data['restaurant_id'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.mailToAdmin')
            ->from('noreply@deliveboo.com')
            ->with([
                'order' => $this->order,
                'restaurant_id' => $this->restaurant_id,
            ]);
    }
}