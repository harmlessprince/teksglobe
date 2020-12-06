<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
			$table->foreignId('style_id')->constrained()->onDelete('cascade');
			$table->string('plan_name');
			$table->unsignedDecimal('minimum', 15);
			$table->unsignedDecimal('maximum', 15);
			$table->unsignedDecimal('percentage', 15);
			$table->unsignedInteger('start_duration');
			$table->unsignedInteger('repeat');
			$table->boolean('status');
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
        Schema::dropIfExists('plans');
    }
}
