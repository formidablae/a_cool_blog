<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        
        $user = Auth::user();

        $post = new Post;
        $data = $request->all();
        $post->fill($data);
        $post->user_id = $user->id;
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

        $user = Auth::user();

        $post = Post::findOrFail($post_id);

        if ($post->user_id == $user->id) {
            $post->fill($request->all());
            $post->save();
            return $post;
        }

        return response("Unauthorized to edit the post", 401);
    }
    
    /**
    * delete a post given its id
    *
    * required
    */
   public function deletePost($post_id) {
        $user = Auth::user();
        $post = Post::findOrFail($post_id);
        
        if ($post->user_id === $user->id) {
            $post->delete();
            return [];
        }

        return response("Unauthorized to delete the post", 401);
   }

    /**
     * getter of all posts of a given user
     */
    public function getAllPostsOfAUser($user_id) {
        User::findOrFail($user_id); 
        return Post::where('user_id', $user_id)->get();
    }

    /**
     * delete all posts of a given user
     */
    public function deleteAllPostsOfAUser() {
        $user = Auth::user();
        Post::where('user_id', $user->id)->delete();
    }
}
