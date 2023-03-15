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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->text('result_description');
            $table->foreignId('axis_id')->constrained('axes');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('indicator_id')->constrained('indicators');
            $table->foreignId('organizational_units_id')->constrained('organizational_units');
            $table->foreignId('year_id')->constrained('years');
            $table->foreignId('period_id')->constrained('periods');
            $table->foreignId('unit_id')->constrained('units');
            $table->softDeletes();
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
        Schema::dropIfExists('results');
    }
};
