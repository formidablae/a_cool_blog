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
$router->get('/posts', PostController::class . '@getAllPosts');  // required endpoint
$router->get('/posts/{post_id}', PostController::class . '@getPost');  // required endpoint
$router->post('/posts', PostController::class . '@newPost');  // required endpoint
$router->put('/posts/{post_id}', PostController::class . '@editPost');  // required endpoint
$router->delete('/posts/{post_id}', PostController::class . '@deletePost');  // required endpoint
$router->get('/users/{user_id}/posts', PostController::class . '@getAllPostsOfAUser');
$router->delete('/users/{user_id}/posts', PostController::class . '@deleteAllPostsOfAUser');

/**
 * Comments endpoints
 */
$router->get('/posts/{post_id}/comments', CommentController::class . '@getAllCommentsOfAPost');  // required endpoint
$router->get('/comments/{comment_id}', CommentController::class . '@getComment');  // required endpoint
$router->post('/comments', CommentController::class . '@newComment');  // required endpoint
$router->put('/comments/{comment_id}', CommentController::class . '@editComment');  // required endpoint
$router->delete('/comments/{comment_id}', CommentController::class . '@deleteComment');  // required endpoint
$router->get('/users/{user_id}/comments', CommentController::class . '@getAllCommentsOfAUser');
$router->delete('/user/{user_id}/comments', CommentController::class . '@deleteAllCommentsOfAUser');
//$router->get('/comments', CommentController::class . '@getAllComments');
$router->delete('/posts/{post_id}/comments', CommentController::class . '@deleteAllCommentsOfAPost');


/**
 * Users endpoints
 */
$router->post('/auth/register', UserController::class . '@newUser');  // required endpoint
$router->post('/auth/login', UserController::class . '@loginUser');  // required endpoint
$router->get('/users', UserController::class . '@getAllUsers');
$router->get('/users/{user_id}', UserController::class . '@getUser');
$router->put('/users/{user_id}', UserController::class . '@editUser');
$router->delete('/users/{user_id}', UserController::class . '@deleteUser');
