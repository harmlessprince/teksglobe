<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrined()->onDelete('cascade');
            $table->unsignedDecimal('amount', 19, 2);
            $table->unsignedDecimal('charge', 19, 2)->default(0);
            $table->json('account')->nullable();
            $table->string('request_ip')->nullable();
            $table->enum('status', ['pending', 'approved', 'declined', 'disbursed'])->default('pending');
            $table->timestamp('verified_at')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable()->constrined('users');
            $table->string('verified_ip')->nullable();
            $table->string('narration')->nullable();
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
        Schema::dropIfExists('withdraws');
    }
}
