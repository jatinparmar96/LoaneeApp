<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('agent_id');
            $table->string('type');
            $table->date('loan_date')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('method');
            $table->double('loan_amount',8,2)->nullable();
            $table->double('installment',8,2);
            $table->double('repay_amount',8,2);
            $table->integer('lending_period')->nullable();
            $table->integer('grace_period')->nullable();
            $table->double('interest_percentage',8,2)->nullable();
            $table->longText('description')->nullable();
            $table->boolean('paid')->default(false);
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
        Schema::dropIfExists('loans');
    }
}
