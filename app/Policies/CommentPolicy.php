<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\Response;

class CommentPolicy {
    /**
     * Permission to edit a comment
     */
    public function editComment(User $user, Comment $comment) {
        if ($user->id === $comment->user_id) return Response::allow();

        return Response::deny("Unauthorized action. Cannot edit another user's comment.");
    }

    /**
     * Permission to delete a comment
     */
    public function deleteComment(User $user, Comment $comment) {
        if ($user->id === $comment->user_id) return Response::allow();

        return Response::deny("Unauthorized action. Cannot delete another user's comment.");
    }
}