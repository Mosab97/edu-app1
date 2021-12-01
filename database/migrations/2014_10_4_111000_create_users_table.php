<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('user_type')->nullable();
            $table->string('status')->default(\App\Models\User::user_status['Pending']);

            $table->string('email')->nullable();//->unique();
            $table->string('username')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->integer('gender')->default(Gender['MALE']);
            $table->boolean('verified')->default(false);
            $table->string('generatedCode')->nullable();
            $table->float('lat', 8, 5)->nullable();
            $table->float('lng', 8, 5)->nullable();


//            $table->enum('local', ['en', 'ar'])->default('ar');
//            $table->date('dob')->nullable();

//            $table->integer('unread_messages')->nullable();
            $table->string('password')->nullable();
            $table->boolean('social')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['phone', 'deleted_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
