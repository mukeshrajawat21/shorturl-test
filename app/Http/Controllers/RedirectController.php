<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Auth;
class RedirectController extends Controller
{

    public function resolve($code)
    {
        $user = Auth::user();

        if ($user->role === 'SuperAdmin') {
            abort(403, 'Not allowed');
        }

        $shortUrl = ShortUrl::where('short_code', $code)->firstOrFail();
        if ($user->role === 'Admin') {

            if ($shortUrl->company_id === $user->company_id) {
                abort(403);
            }
        }

        if ($user->role === 'Member') {
            if ($shortUrl->user_id === $user->id) {
                abort(403);
            }
        }

        $shortUrl->increment('hits');

        return redirect()->away($shortUrl->original_url);
    }


}

