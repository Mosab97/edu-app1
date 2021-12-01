<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('currency')->nullable();
            $table->integer('amount')->nullable()->unsigned();
            $table->string('payer_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
