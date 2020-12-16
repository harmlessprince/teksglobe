<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrined()->onDelete('cascade');
            $table->unsignedBigInteger('package_id')->constrined()->onDelete('cascade');
			$table->unsignedDecimal('amount', 19, 2);
			$table->unsignedDecimal('returns', 19, 2);
            $table->unsignedDecimal('balance', 19, 2);
            $table->string('gateway');
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->string('evidence')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable()->constrined('users');
            $table->json('info')->nullable();
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
        Schema::dropIfExists('investments');
    }
}
