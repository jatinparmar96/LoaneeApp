<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanRoomRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_room_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id');
            $table->date('record_date');
            $table->double('record_amount',8,2);
            $table->double('remaining_amount',8,2);
            $table->date('penalty_date');
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
        Schema::dropIfExists('loan_room_records');
    }
}
