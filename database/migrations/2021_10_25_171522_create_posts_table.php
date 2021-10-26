<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');  // automatically increments id of type unsigned integer, unique
            $table->unsignedInteger('user_id');  // creates a column for user_id unsigned integers
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');  // makes user_id a foreign key to id of the users table
            $table->string('title');  // post's title
            $table->text('content');  // post's content
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
        Schema::dropIfExists('posts');
    }
}
