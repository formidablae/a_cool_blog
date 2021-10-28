<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class PostController extends BaseController {
    /**
     * getter of all posts
     * 
     * required
     */
    public function getAllPosts() {
        return Post::all();
    }
    
    /**
     * getter of a post given its id
     * 
     * comments_count is by default included
     * if $comment=0, comments_count is not included
     * 
     * required
     */
    public function getPost(Request $request, $post_id) {
        $data = $request->all();
        $post = Post::when($data['comments'] == 1, function ($query) {
            $query->with('comments');
        })->findOrFail($post_id);
        return $post;
    }

    /**
     * create a new post
     * 
     * required
     */
    public function newPost(Request $request) {
        /**
        * Validate request data before new post creation
        */
        $this->validate($request, ['title' => 'required', 'content' => 'required']);

        $post = new Post;
        $data = $request->all();
        $post->fill($data);
        if (!isset($post->user_id)) $post->user_id = 1;  // TODO: to be removed with authentication implementation
        $post->save();
        return $post;
    }

    /**
     * edit a post
     * 
     * required
     */
    public function editPost(Request $request, $post_id) {
        /**
        * Validate request data before post edit
        */
        $this->validate($request, ['title' => 'filled', 'content' => 'filled']);

        $post = Post::findOrFail($post_id);
        $post->fill($request->all());
        $post->save();
        return $post;
    }
    
    /**
    * delete a post given its id
    *
    * required
    */
   public function deletePost($post_id) {
       $post = Post::findOrFail($post_id);
       $post->delete();
       return [];
   }

    /**
     * getter of all posts of a given user
     */
    public function getAllPostsOfAUser($user_id) {
        User::findOrFail($user_id);  // TODO: to remove when auth implemented
        return Post::where('user_id', $user_id)->get();
    }

    /**
     * delete all posts of a given user
     */
    public function deleteAllPostsOfAUser($user_id) {
        User::findOrFail($user_id);  // TODO: to remove when auth implemented
        Post::where('user_id', $user_id)->delete();
    }
}
