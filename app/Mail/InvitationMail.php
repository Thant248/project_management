<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\HtmlString;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $password;

    public string $email;

    public HtmlString $qrCode;

    public function __construct(string $name, string $password, string $email, HtmlString $qrCode)
    {
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->qrCode = $qrCode;
    }

    public function build(): self
    {
        return $this->view('emails.invitation', [
            'name' => $this->name,
            'password' => $this->password,
            'email' => $this->email,
            'qrCode' => $this->qrCode,
        ])->subject('【ドクターズレシピ】 会員登録いただきありがとうございます');
    }

}
