<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $passowrd;

    public string $email;

    public function __construct(string $name, string $password, string $email)
    {
        $this->name = $name;
        $this->passowrd = $password;
        $this->email = $email;
    }

    public function build(): self
    {
        return $this->view('emails.invitation', [
            'name' => $this->name,
            'password' => $this->passowrd,
            'email' => $this->email,
        ])->subject('【ドクターズレシピ】 会員登録いただきありがとうございます');
    }

}
