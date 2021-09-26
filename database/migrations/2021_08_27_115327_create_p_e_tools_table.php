<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePEToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_e_tools', function (Blueprint $table) {
            $table->id();
            $table->string('fb_id');
            $table->string('fb_name');
            $table->string('fb_link');
            $table->longText('fb_picture');
            $table->longText('fb_access_token');
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
        Schema::dropIfExists('p_e_tools');
    }
}
