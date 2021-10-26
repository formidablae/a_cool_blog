<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Client\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class CommentController extends BaseController {
    /**
     * getter of a comment given its id
     */
    public function getComment($id) {
        return Comment::find($id);
    }

    /**
    * getter of all comments
    */
   public function getAllComments() {
       return Comment::all();
   }

    /**
     * getter of all comments of a given post
     */
    public function getAllCommentsOfAPost($post_id) {
        return Comment::where('post_id', $post_id)->get();
    }

    /**
     * getter of all comments of a given user
     */
    public function getAllCommentsOfAUser($user_id) {
        return Comment::where('user_id', $user_id)->get();
    }

    /**
     * create a new comment
     */
    public function newComment(Request $request, $user_id, $post_id) {
        $comment = new Comment;
        $comment->fill($request->all());
        $comment->user_id = $user_id;
        $comment->post_id = $post_id;
        $comment->save();
    }

    /**
     * edit a comment
     */
    public function editComment(Request $request, $comment_id) {
        $comment = $this->getComment($comment_id);
        $comment->fill($request->all());
        $comment->save();
    }

    /**
     * delete a comment given its id
     */
    public function deleteComment($comment_id) {
        $comment = $this->getComment($comment_id);
        $comment->delete();
    }

    /**
     * delete all comments of a given post
     */
    public function deleteAllCommentsOfAPost($post_id) {
        $listOfComments = $this->getAllCommentsOfAPost($post_id);
        foreach ($listOfComments as $comment) {
            $comment->delete();
        }
    }

    /**
     * delete all comments of a given user
     */
    public function deleteAllCommentsOfAUser($user_id) {
        $listOfComments = $this->getAllCommentsOfAUser($user_id);
        foreach ($listOfComments as $comment) {
            $comment->delete();
        }
    }
}
