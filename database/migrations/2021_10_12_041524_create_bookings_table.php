<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); //id auto increment
            $table->uuid('uuid'); //unique identifier - for security random number 
            $table->string('applicant')->nullable();
            $table->text('purpose')->nullable();
            $table->text('notes')->nullable();
            $table->string('participant_total')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('room_id')->unsigned()->nullable();
            $table->integer('booking_status_id')->unsigned()->nullable();
            $table->boolean('enabled')->default(true);
            $table->timestamps();
            $table->softDeletes(); //column deleted at - kalau ada value kira delete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
