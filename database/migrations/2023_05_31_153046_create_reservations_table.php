<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('zip_code');
            $table->string('city');
            $table->string('state');
            $table->string('email')->unique();
            $table->string('phone');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->string('check_in_time')->nullable();
            $table->string('check_out_time')->nullable();
            $table->integer('no_of_adults')->nullable();
            $table->integer('no_of_children')->default(0);
            $table->integer('no_of_rooms')->nullable();
            $table->string('room_1_type')->nullable();
            $table->string('room_2_type')->nullable();
            $table->longText('instructions')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
