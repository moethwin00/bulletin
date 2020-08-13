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
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('description');
            $table->Integer('status')->default('1');
            $table->Integer('create_user_id')->unsigned()->constraint()->index();
            $table->foreign('create_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->Integer('updated_user_id')->unsigned()->constraint()->index();
            $table->foreign('updated_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->Integer('deleted_user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('posts');
        Schema::enableForeignKeyConstraints();
    }
}
