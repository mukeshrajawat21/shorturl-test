<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardContorller extends Controller
{
  
   public function index(){
        $user = auth()->user();

        if($user->role=='SuperAdmin'){
            $urls = collect();
        }
        elseif($user->role=='Admin'){
            $urls = ShortUrl::whereHas('user', function($q) use($user){
                $q->where('company_id','!=',$user->company_id);
            })->get();
        }
        elseif($user->role=='Member'){
            $urls = ShortUrl::where('user_id','!=',$user->id)->get();
        }
        else{ // Sales, Manager
            $urls = ShortUrl::where('user_id',$user->id)->get();
        }

        return view('admin.dashboard', compact('urls','user'));
    }


}
