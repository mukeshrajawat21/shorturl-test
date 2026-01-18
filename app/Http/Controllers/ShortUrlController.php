<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;


class ShortUrlController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'Admin') {
            $urls = ShortUrl::where('company_id','!=',$user->company_id)->get();
        } elseif ($user->role === 'Member') {
            $urls = ShortUrl::where('user_id','!=',$user->id)->get();
        } else {
            abort(403);
        }

        return view('shorturls.index', compact('urls'));
    }


   public function store(Request $request){
        $user = auth()->user();

        if(in_array($user->role,['Admin','Member','SuperAdmin'])){
            abort(403); 
        }

        $request->validate(['original_url'=>'required|url']);

        $shortCode = Str::random(6);

        $url = ShortUrl::create([
            'original_url'=>$request->original_url,
            'short_code'=>$shortCode,
            'user_id'=>$user->id
        ]);

        return back()->with('success','Short URL generated: '.url('/s/'.$shortCode));
    }

    public function redirect($code){
        $url = ShortUrl::where('short_code',$code)->firstOrFail();
        $url->increment('hits');
        return redirect($url->original_url);
    }



  }

