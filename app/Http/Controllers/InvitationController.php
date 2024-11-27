<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Mail\InvitationMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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

        Mail::to($data['email'])->send(new InvitationMail($data['name'], $password, $data['email']));
        User::create($data);

        return to_route('invite.index')->with('success', 'User has been successfully invited');
        
    }
}
