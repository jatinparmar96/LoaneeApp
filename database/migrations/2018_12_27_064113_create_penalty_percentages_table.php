<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenaltyPercentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penalty_percentages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id');
            $table->integer('loan_installment_amount');
            $table->integer('amount');
            $table->integer('received_amount');
            $table->date('penalty_date');
            $table->boolean('paid')->default(false);
            $table->boolean('active_status')->default(false);
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
        Schema::dropIfExists('penalty_percentages');
    }
}
