<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

class CommentController extends BaseController {
    /**
     * getter of all comments of a given post
     * or if no post_id given, return all comments of all posts
     * 
     * required
     */
    public function getAllCommentsOfAPost(Request $request) {
        $data = $request->all();
        $comments = Comment::when(isset($data['post_id']), function ($query) use ($data) {
            Post::findOrFail($data['post_id']);
            $query->where('post_id', $data['post_id']);
        })->get();
        return $comments;
    }

    /**
     * getter of a comment given its id
     * 
     * required
     */
    public function getComment($comment_id) {
        return Comment::findOrFail($comment_id);
    }

    /**
     * create a new comment
     * 
     * required
     */
    public function newComment(Request $request) {
        /**
        * Validate request data before new comment creation
        */
        $this->validate($request, ['content' => 'required']);

        Auth::user();
        $data = $request->all();
        $post = Post::findOrFail($data["post_id"]);

        if ($post) {
            $comment = new Comment;
            $comment->fill($data);
            $comment->post_id = $post->id;
            //$comment->user_id = Auth::user()->id;
            $comment->save();
            return $comment;
        }
        return response("Post doesn't exist", 404);
    }

    /**
     * edit a comment
     * 
     * required
     */
    public function editComment(Request $request, $comment_id) {
        /**
        * Validate request data before comment edit
        */
        $this->validate($request, ['content' => 'filled']);

        $user = Auth::user();

        if ($user->subscription === "premium") {  // user has to be premium to edit their comments
            $comment = $this->getComment($comment_id);

            if ($user->id === $comment->user_id) {
                $comment->fill($request->all());
                $comment->save();
                return $comment;
            }

            return response("Unauthorized action. Cannot edit another user's comment.", 401);
        }

        return response("Unauthorized action, only premium users can edit comments.", 401);
    }

    /**
     * delete a comment given its id
     * 
     * required
     */
    public function deleteComment($comment_id) {
        $user = Auth::user();

        if ($user->subscription === "premium") {  // user has to be premium to edit their comments
            $comment = $this->getComment($comment_id);

            if ($user->id === $comment->user_id) {
                $comment->delete();
                return [];
            }

            return response("Unauthorized action. Cannot delete another user's comment.", 401);
        }

        return response("Unauthorized action, only premium users can delete comments.", 401);
    }

    /**
     * getter of all comments of a given user
     */
    public function getAllCommentsOfAUser($user_id) {
        User::findOrFail($user_id);
        return Comment::where('user_id', $user_id)->get();
    }

    /**
     * delete all comments of a given post
     */
    public function deleteAllCommentsOfAPost($post_id) {
        $user = Auth::user();
        if ($user->subscription === "premium") {  // user has to be premium to edit their comments
            Post::findOrFail($post_id);
            Comment::where('post_id', $post_id)->where('user_id', $user->id)->delete();
        }

        return response("Unauthorized action, only premium users can delete their comments.", 401);
    }

    /**
     * delete all comments of a given user
     */
    public function deleteAllCommentsOfAUser() {
        $user = Auth::user();
        if ($user->subscription === "premium") {  // user has to be premium to edit their comments
            Comment::where('user_id', $user->id)->delete();
        }

        return response("Unauthorized action, only premium users can delete their comments.", 401);
    }
}
