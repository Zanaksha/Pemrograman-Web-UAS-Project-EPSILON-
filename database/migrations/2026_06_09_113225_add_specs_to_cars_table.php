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
        Schema::table('cars', function (Blueprint $table) {
            $table->string('engine')->nullable();
            $table->string('transmission')->nullable();
            $table->string('power')->nullable();
            $table->string('torque')->nullable();
            $table->string('acceleration')->nullable();
            $table->string('top_speed')->nullable();
            $table->string('fuel_consumption')->nullable();
            $table->decimal('price', 15, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['engine','transmission','power','torque','acceleration','top_speed','fuel_consumption','price']);
        });
    }
};
