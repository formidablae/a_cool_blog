<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Client\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class PostController extends BaseController {
    /**
     * getter of a post given its id
     */
    public function getPost($id) {
        return Post::find($id);
    }

    /**
     * getter of all posts
     */
    public function getAllPosts() {
        return Post::all();
    }

    /**
     * getter of all posts of a given user
     */
    public function getAllPostsOfAUser($user_id) {
        return Post::where('user_id', $user_id)->get();
    }

    /**
     * create a new post
     */
    public function newPost(Request $request, $user_id) {
        $post = new Post;
        $post->fill($request->all());
        $post->user_id = $user_id;
        $post->save();
    }

    /**
     * edit a post
     */
    public function editPost(Request $request, $post_id) {
        $post = $this->getPost($post_id);
        $post->fill($request->all());
        $post->save();
    }

    /**
     * delete a post given its id
     */
    public function deletePost($post_id) {
        $post = $this->getPost($post_id);
        $post->delete();
    }

    /**
     * delete all posts of a given user
     */
    public function deleteAllPostsOfAUser($user_id) {
        $listOfPosts = $this->getAllPostsOfAUser($user_id);
        foreach ($listOfPosts as $post) {
            $post->delete();
        }
    }
}
