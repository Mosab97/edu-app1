<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {

        return $this->view('emails.forget_password', [
//            'code' => $this->user->generatedCode
            'user' => $this->user
        ])->subject(trans('Verification Code'));
    }
}
