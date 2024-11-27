<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Mail\InvitationMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvitationController extends Controller
{
    public function index()
    {
        return Inertia('Mail/Invite');
    }

    public function store(StoreUserRequest $request){

        $data = $request->validated();

        $data['email_verified_at'] = time();
        $password = 'password';
        $data['password'] = bcrypt($password);
        $qrCode = QrCode::format('svg')->size(300)->generate("{$data['name']}");
        Mail::to($data['email'])->send(new InvitationMail($data['name'], $password, $data['email'], $qrCode));
        User::create($data);

        return to_route('user.index')->with('success', 'User has been successfully invited');

    }
}
