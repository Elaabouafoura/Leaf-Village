<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupplierAIEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;
    public $subjectLine;

    public function __construct($subjectLine, $messageContent)
    {
        $this->subjectLine = $subjectLine;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
            ->view('emails.supplier')
            ->with(['messageContent' => $this->messageContent]);
    }
}
