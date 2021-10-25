<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->unique();  // automatically increments id of type unsigned integer, unique
            $table->unsignedInteger('user_id');  // creates a column for user_id unsigned integers
            $table->foreign('user_id')->references('id')->on('users');  // makes user_id a foreign key to id of the users table
            $table->unsignedInteger('post_id');  // creates a column for post_id unsigned integers
            $table->foreign('post_id')->references('id')->on('users');  // makes post_id a foreign key to id of the posts table
            $table->string('content');  // comment's content
            $table->timestamps();  // generates created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
