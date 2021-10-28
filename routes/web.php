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
    $router->get('', PostController::class . '@getAllPosts');  // required endpoint
    $router->get('/{post_id}', PostController::class . '@getPost');  // required endpoint
    $router->post('', PostController::class . '@newPost');  // required endpoint
    $router->put('/{post_id}', PostController::class . '@editPost');  // required endpoint
    $router->delete('/{post_id}', PostController::class . '@deletePost');  // required endpoint
});
$router->get('/users/{user_id}/posts', PostController::class . '@getAllPostsOfAUser');
$router->delete('/users/{user_id}/posts', PostController::class . '@deleteAllPostsOfAUser');

/**
 * Comments endpoints
 */
$router->group(['prefix' => 'comments'], function () use ($router) {
    $router->get('/{comment_id}', CommentController::class . '@getComment');  // required endpoint
    $router->post('', CommentController::class . '@newComment');  // required endpoint
    $router->put('/{comment_id}', CommentController::class . '@editComment');  // required endpoint
    $router->delete('/{comment_id}', CommentController::class . '@deleteComment');  // required endpoint
    $router->get('', CommentController::class . '@getAllComments');
});
$router->get('/posts/{post_id}/comments', CommentController::class . '@getAllCommentsOfAPost');  // required endpoint
$router->get('/users/{user_id}/comments', CommentController::class . '@getAllCommentsOfAUser');
$router->delete('/user/{user_id}/comments', CommentController::class . '@deleteAllCommentsOfAUser');
$router->delete('/posts/{post_id}/comments', CommentController::class . '@deleteAllCommentsOfAPost');


/**
 * Users endpoints
 */
$router->post('/auth/register', UserController::class . '@newUser');  // required endpoint
$router->post('/auth/login', UserController::class . '@loginUser');  // required endpoint
$router->group(['prefix' => 'users'], function () use ($router) {
    $router->get('', UserController::class . '@getAllUsers');
    $router->get('/{user_id}', UserController::class . '@getUser');
    $router->put('/{user_id}', UserController::class . '@editUser');
    $router->delete('/{user_id}', UserController::class . '@deleteUser');
});
