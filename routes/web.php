<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/**
 * Posts endpoints
 */
$router->group(['prefix' => 'posts'], function () use ($router) {
    /**
     * endpoints requiring authorization
     */
    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->post('', PostController::class . '@newPost');  // required endpoint
        $router->put('/{post_id}', PostController::class . '@editPost');  // required endpoint
        $router->delete('/{post_id}', PostController::class . '@deletePost');  // required endpoint
        $router->delete('/{post_id}/comments', CommentController::class . '@deleteAllCommentsOfAPost');
    });

    /**
     * endpoints not requiring authorization
     */
    $router->get('', PostController::class . '@getAllPosts');  // required endpoint
    $router->get('/{post_id}', PostController::class . '@getPost');  // required endpoint
});

/**
 * Comments endpoints
 */
$router->group(['prefix' => 'comments'], function () use ($router) {
    /**
     * endpoints requiring authorization
     */
    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->post('', CommentController::class . '@newComment');  // required endpoint
        $router->put('{comment_id}', CommentController::class . '@editComment');  // required endpoint
        $router->delete('{comment_id}', CommentController::class . '@deleteComment');  // required endpoint
        $router->delete('', CommentController::class . '@deleteAllCommentsOfAUser');
    });

    /**
     * endpoints not requiring authorization
     */
    $router->get('{comment_id}', CommentController::class . '@getComment');  // required endpoint
    $router->get('', CommentController::class . '@getAllCommentsOfAPost');  // required endpoint
    $router->get('{user_id}/comments', CommentController::class . '@getAllCommentsOfAUser');
});

/**
 * Users endpoints
 */
$router->post('/auth/register', UserController::class . '@newUser');  // required endpoint
$router->post('/auth/login', UserController::class . '@loginUser');  // required endpoint
$router->group(['prefix' => 'users'], function () use ($router) {
    /**
     * endpoints requiring authorization
     */
    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->put('{user_id}', UserController::class . '@editUser');
        $router->delete('', UserController::class . '@deleteUser');
        $router->delete('posts', PostController::class . '@deleteAllPostsOfAUser');
    });

    /**
    * endpoints not requiring authorization
    */
    $router->get('', UserController::class . '@getAllUsers');
    $router->get('{user_id}', UserController::class . '@getUser');
    $router->get('{user_id}/posts', PostController::class . '@getAllPostsOfAUser');
});
