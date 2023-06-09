<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_no');
            $table->string('room_name')->nullable();
            $table->integer('type'); // types of rooms, regular, deluxe, presidential etc
            $table->float('price',30,2);
            $table->boolean('status')->default(0);// available 1 or booked 0
            $table->foreignId('accomodation_id')->constrained('accomodations');
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
        Schema::dropIfExists('rooms');
    }
};
