<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->text('title')->nullable();
            $table->string('mobile')->nullable();
            $table->text('message')->nullable();
            $table->string('email')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('seen')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}
