<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('plans');
            $table->longText('description')->nullable();
            $table->float('price')->nullable();
            $table->integer('duration')->nullable(); // month
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
        Schema::dropIfExists('plans');
    }
}
