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

$router->get('/users', UserController::class . '@getAllUsers');
$router->get('/user/{id}', UserController::class . '@getUser');
$router->post('/user/new', UserController::class . '@newUser');
$router->delete('/user/{id}/delete', UserController::class . '@deleteUser');
$router->get('/user/{user_id}/posts', PostController::class . '@getAllPostsOfAUser');
$router->get('/user/{user_id}/comments', PostController::class . '@getAllCommentsOfAUser');

$router->get('/posts', PostController::class . '@getAllPosts');
$router->get('/post/{id}', PostController::class . '@getPost');
$router->post('/post/{user_id}/new', PostController::class . '@newPost');
$router->post('/post/{post_id}/edit', PostController::class . '@editPost');
$router->delete('/post/{post_id}/delete', PostController::class . '@deletePost');
$router->delete('/posts/{user_id}/delete', PostController::class . '@deleteAllPostsOfAUser');

$router->get('/comments', CommentController::class . '@getAllComments');
$router->get('/comment/{id}', CommentController::class . '@getComment');
$router->post('/comment/{user_id}/{post_id}/new', PostController::class . '@newComment');
$router->post('/comment/{comment_id}/new', CommentController::class . '@editComment');
$router->delete('/comment/{comment_id}/delete', CommentController::class . '@deleteComment');
$router->delete('/comments/{post_id}/delete', CommentController::class . '@deleteAllCommentsOfAPost');
$router->delete('/comments/{user_id}/delete', CommentController::class . '@deleteAllCommentsOfAUser');
