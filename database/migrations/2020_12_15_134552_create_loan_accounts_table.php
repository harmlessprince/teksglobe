<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrined()->onDelete('cascade');
            $table->unsignedBigInteger('investment_id')->constrined()->onDelete('cascade');
            $table->string('narration')->nullable();
            $table->decimal('amount', 19, 2)->default(0);
            $table->enum('type', ['credit', 'debit']);
            $table->decimal('balance', 19, 2)->default(0);
            $table->decimal('total', 19, 2)->default(0);
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
        Schema::dropIfExists('loan_accounts');
    }
}
