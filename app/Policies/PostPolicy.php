<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function update(User $user, Post $post) {
        return $user->ownsPost($post);
    }

    public function destroy(User $user, Post $post) {
        return $user->ownsPost($post);
    }
    
    public function like(User $user, Post $post) {
        return !$user->ownsPost($post);
    }

    public function dislike(User $user, Post $post) {
        return !$user->ownsPost($post);
    }
}
