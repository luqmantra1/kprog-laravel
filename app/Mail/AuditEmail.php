<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AuditEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $log;

    public function __construct($log)
    {
        $this->log = $log;
    }

    public function build()
    {
        return $this->subject('Audit Log Notification')
                    ->view('emails.mail-log');
    }
}

