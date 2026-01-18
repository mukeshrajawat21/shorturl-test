<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;

class InvitationController extends Controller
{
public function send(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'email' => 'required|email|unique:users,email',
        'role' => 'required|string'
    ]);

    // Admin cannot invite Admin/Member
    if($user->role === 'Admin' && in_array($request->role,['Admin','Member'])){
        return back()->with('error','Admin cannot invite Admin or Member.');
    }

    $companyId = $user->role === 'Admin' ? $user->company_id : null;

    $invite = Invitation::create([
        'email' => $request->email,
        'role' => $request->role,
        'company_id' => $companyId,
        'token' => Str::uuid(),
    ]);

    try {
        Mail::to($invite->email)->send(new InvitationMail(url('/invite/'.$invite->token)));
        return back()->with('success','Invitation sent successfully to '.$invite->email);
    } catch (\Exception $e) {
        return back()->with('error','Mail could not be sent. '.$e->getMessage());
    }
}

    public function accept($token){
        $invite = Invitation::where('token',$token)->firstOrFail();
        return view('emails.register', compact('invite'));
    }

    public function register(Request $request){
        $request->validate([
            'token'=>'required',
            'name'=>'required|string',
            'password'=>'required|confirmed|min:6'
        ]);

        $invite = Invitation::where('token',$request->token)->firstOrFail();

        $user = User::create([
            'name'=>$request->name,
            'email'=>$invite->email,
            'password'=>Hash::make($request->password),
            'role'=>$invite->role,
            'company_id'=>$invite->company_id
        ]);

        $invite->delete();
        auth()->login($user);
        return redirect()->route('dashboard');
    }
}
