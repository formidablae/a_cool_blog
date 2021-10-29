<?php

namespace App\Http\Traits;
use Illuminate\Http\Client\Request;

trait PostTrait {
    public function getAllPosts() {}
    
    public function getPost(Request $request, $post_id) {}

    public function newPost(Request $request) {}

    public function editPost(Request $request, $post_id) {}
    
    public function deletePost($post_id) {}

    public function getAllPostsOfAUser($user_id) {}

    public function deleteAllPostsOfAUser() {}
}
