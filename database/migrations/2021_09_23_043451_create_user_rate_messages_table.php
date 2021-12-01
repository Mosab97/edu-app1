<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rate_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_id')->nullable();
            $table->integer('from_type')->default(\App\Models\User::user_type['STUDENT']);
            $table->unsignedBigInteger('to_id')->nullable();
            $table->integer('to_type')->default(\App\Models\User::user_type['TEACHER']);
            $table->double('avg')->default(0);
            $table->longText('message')->nullable();
            $table->foreign('from_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('to_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_rate_messages');
    }
}
