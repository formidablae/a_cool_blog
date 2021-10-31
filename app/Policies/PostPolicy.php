<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\Response;

class PostPolicy {
    /**
     * Permission to edit a post
     */
    public function editPost(User $user, Post $post) {
        if ($user->id === $post->user_id) return Response::allow();
        
        return Response::deny("Unauthorized action. Cannot edit another user's post");
    }

    /**
     * Permission to delete a post
     */
    public function deletePost(User $user, Post $post) {
        if ($user->id === $post->user_id) return Response::allow();
        
        return Response::deny("Unauthorized action. Cannot delete another user's post");
    }
}