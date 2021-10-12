<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });

        //data dalam room categories
        DB::table('room_categories')->insert([
            ['name' => 'Bilik Mesyuarat'],
            ['name' => 'Bilik Perbincangan'],
            ['name' => 'Bilik Latihan ICT'],

        ]);

        //untuk update
        DB::table ('room_categories')->update(['created_at' => now(), 'updated_at' => now()]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_categories');
    }
}
