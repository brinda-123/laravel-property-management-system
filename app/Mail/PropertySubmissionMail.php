<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PropertySubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $propertyData;
    public $sellerName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($propertyData, $sellerName)
    {
        $this->propertyData = $propertyData;
        $this->sellerName = $sellerName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Property Submission from Seller')
                    ->view('emails.property_submission');
    }
}
