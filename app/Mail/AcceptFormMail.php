<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcceptFormMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $code;

    /**
     * Create a new message instance.
     *
     * @param $status
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.accept')->subject('اقرار بحالة الطلب')->with(['status'=>$this->status]);
    }
}
