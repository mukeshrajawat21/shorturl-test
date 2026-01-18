<?php

namespace App\Policies;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShortUrlPolicy
{
    public function create(User $user)
    {
        return in_array($user->role, ['Sales','Manager']);
    }

    public function viewAny(User $user)
    {
        return $user->role !== 'SuperAdmin';
    }
}

