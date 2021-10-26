<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');  // automatically increments id of type unsigned integer, equivalent of a primary key
            $table->string('first_name')->nullable();  // user's first name column, null by default
            $table->string('last_name')->nullable();  // user's last name column, null by default
            $table->string('email');  // column for email address. todo: validate the address is a valid one.
            $table->string('password');  //  column for password. todo: make it hashed using the Hash facade from Lumen
            $table->string('api_token', 64);  // column for API token string. todo: make it randomly generated
            $table->string('picture')->nullable();  // creates a column that will contain a picture URL, null by default
            $table->enum('subscription', ['free', 'premium'])->default('free');  // generates a subscription column of type enumeration free or premium, by default free
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
        Schema::dropIfExists('users');
    }
}
