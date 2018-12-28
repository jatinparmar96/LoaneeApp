<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('building_name');
            $table->string('room_no');
            $table->string('name');
            $table->string('mobile_no');
            $table->string('img')->nullable();
            $table->integer('agent_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('loan_amount', 8, 2);
            $table->double('installment', 8, 2);
            $table->double('repay_amount', 8, 2);
            $table->double('paid_amount', 8, 2);
            $table->integer('grace_period')->nullable();
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
        Schema::dropIfExists('loan_rooms');
    }
}
