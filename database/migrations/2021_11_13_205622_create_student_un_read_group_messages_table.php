<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentUnReadGroupMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_un_read_group_messages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('number')->nullable();
            $table->foreign('group_id')->on('groups')->references('id')->cascadeOnDelete();
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();


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
        Schema::dropIfExists('student_un_read_group_messages');
    }
}
