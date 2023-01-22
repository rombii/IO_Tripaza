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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('city');
            $table->date('begin_date');
            $table->date('end_date');
            $table->decimal('price_person', $precision = 10, $scale = 2);
            $table->boolean('last_minute');
            $table->enum('food_option', ['All Inclusive', '3 course', 'Breakfast and Dinner', 'Breakfast', 'Without food']);
            $table->integer('participants_number_left');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
};
