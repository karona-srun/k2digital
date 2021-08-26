<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->integer('like');
            $table->integer('post_id')->foreign('post_id')
                    ->references('id')
                    ->on('posts')
                    ->onDelete('cascade');
            $table->integer('created_by')->foreign('created_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->integer('updated_by')->foreign('updated_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
