<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenaltyRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penalty_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id');
            $table->integer('loan_installment_amount')->default(500);
            $table->integer('count')->default(1);
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
        Schema::dropIfExists('penalty_rooms');
    }
}
