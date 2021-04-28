<?php

namespace App\Mail;

use App\Http\Enums\GlobalSettings;
use App\Http\Traits\GlobalSettingsTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;
    use GlobalSettingsTrait;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = $this->getGlobalSettingValueByName(GlobalSettings::ADMIN_EMAIL);
        $subject = 'Checkout Report!';
        $name = 'KodeStudio.net';

        return $this->view('emails.test')
            ->from($address, $name)
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with($this->data);
    }
}
