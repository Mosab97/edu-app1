<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_id')->nullable();
            $table->unsignedBigInteger('to_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();

            $table->integer('from_type')->default(\App\Models\User::user_type['STUDENT']);
            $table->integer('to_type')->default(\App\Models\User::user_type['TEACHER']);

            $table->longText('message');
            $table->foreign('from_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('to_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');


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
        Schema::dropIfExists('complaints');
    }
}
