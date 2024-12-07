<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the authenticated user can modify the given post.
     *
     * @param User $user The currently authenticated user.
     * @param Post $post The post being checked for modification access.
     * @return Response Authorization response indicating allow or deny.
     */
    public function modify(User $user, Post $post): Response
    {
        // Check if the user's ID matches the post's user_id.
        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to modify this post.');
    }
}
