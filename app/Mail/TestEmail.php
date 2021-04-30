<?php

namespace App\Mail;

use App\Http\Enums\GlobalSettings;
use App\Http\Traits\GlobalSettingsTrait;
use App\Http\Traits\AuthUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;
    use GlobalSettingsTrait;
    use AuthUser;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = $this->getGlobalSettingValueByName(GlobalSettings::ADMIN_EMAIL);
        $user = $this->getAuthUser();
        $subject = 'Checkout Report - ('.date('d-m-Y').')';
        $name = isset($user->first_name) ? $user->first_name . ' ' . $user->last_name : 'KodeStudio.net';
        return $this->view('emails.test')
            ->to($address, $name)
            ->from($user->email, $name)
            ->cc($user->email, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with($this->data);
    }
}
