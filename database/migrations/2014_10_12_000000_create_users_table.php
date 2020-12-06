<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('pin')->unique()->nullable();
            $table->boolean('admin')->default(false);
            $table->date('membership_started');
            $table->date('membership_expired');
            $table->string('phone_verification_code')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
