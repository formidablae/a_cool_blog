<?php

namespace App\Http\Traits;
use Illuminate\Http\Client\Request;

trait CommentTrait {
    public function getAllCommentsOfAPost(Request $request) {}

    public function getComment($comment_id) {}

    public function newComment(Request $request) {}

    public function editComment(Request $request, $comment_id) {}

    public function deleteComment($comment_id) { }

    public function getAllCommentsOfAUser($user_id) {}

    public function deleteAllCommentsOfAPost($post_id) {}

    public function deleteAllCommentsOfAUser() {}
}
