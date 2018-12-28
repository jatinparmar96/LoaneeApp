<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanPercentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_percentages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('agent_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('loan_amount', 8, 2);
            $table->double('installment', 8, 2);
            $table->double('repay_amount', 8, 2);
            $table->double('paid_amount', 8, 2);
            $table->integer('lending_period')->nullable();
            $table->integer('grace_period')->nullable();
            $table->double('percentage', 8, 2)->nullable();
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
        Schema::dropIfExists('loan_percentages');
    }
}
