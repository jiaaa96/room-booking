<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });

        DB::table('booking_statuses')->insert([
            ['name' => 'Dalam proses', 'color' => '#3B82F6'],
            ['name' => 'Lulus', 'color' => '#10B981'],
            ['name' => 'Tidak Lulus', 'color' => '#EF4444'],
        ]);

        DB::table('booking_statuses')->update(['created_at' => now(), 'updated_at' => now()]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_statuses');
    }
}
