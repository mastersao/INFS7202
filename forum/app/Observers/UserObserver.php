<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Support\Str;


class UserObserver
{
    public function creating(User $user)
    {
        $user->verification_code=Str::random(30);
    }
}
