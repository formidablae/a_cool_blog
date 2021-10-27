<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class CommentController extends BaseController {
    /**
     * getter of all comments of a given post
     * 
     * required
     */
    public function getAllCommentsOfAPost($post_id) {
        return Comment::where('post_id', $post_id)->get();
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

        $comment = new Comment;
        $data = $request->all();
        $comment->fill($data);
        $comment->post_id = $data["post_id"];
        if (!isset($comment->user_id)) $comment->user_id = 1;  // to be removed with authentication implementation
        $comment->save();
        return $comment;
    }

    /**
     * edit a comment
     * 
     * required
     */
    public function editComment(Request $request, $comment_id) {
        /**
        * Validate request data before new comment edit
        */
        $this->validate($request, ['content' => 'required']);

        $comment = $this->getComment($comment_id);
        $comment->fill($request->all());
        $comment->save();
        return $comment;
    }

    /**
     * delete a comment given its id
     * 
     * required
     */
    public function deleteComment($comment_id) {
        $comment = $this->getComment($comment_id);
        $comment->delete();
        return [];
    }

    /**
    * getter of all comments
    */
   public function getAllComments() {
       return Comment::all();
   }

    /**
     * getter of all comments of a given user
     */
    public function getAllCommentsOfAUser($user_id) {
        return Comment::where('user_id', $user_id)->get();
    }

    /**
     * delete all comments of a given post
     */
    public function deleteAllCommentsOfAPost($post_id) {
        Comment::where('post_id', $post_id)->delete();
    }

    /**
     * delete all comments of a given user
     */
    public function deleteAllCommentsOfAUser($user_id) {
        Comment::where('user_id', $user_id)->delete();
    }
}
