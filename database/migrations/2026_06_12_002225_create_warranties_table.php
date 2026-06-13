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
        Schema::create('warranties', function (Blueprint $table) {
            $table->id();
            $table->string('vin')->unique();
            $table->string('owner_name');
            $table->string('owner_email');
            $table->string('car_model');
            $table->string('car_year');
            $table->date('purchase_date');
            $table->date('warranty_start');
            $table->date('warranty_end');
            $table->enum('status', ['active', 'expired', 'void'])->default('active');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('warranties');
    }
};
