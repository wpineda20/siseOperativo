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
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->string('indicator_name');
            // $table->string('strategic_indicator');
                // $table->foreignId('unit_id')->references('id')->on('units');
                // $table->foreignId('institution_id')->references('id')->on('institutions');
                // $table->foreignId('organizational_unit_id')->references('id')->on('organizational_units');
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
        Schema::dropIfExists('indicators');
    }
};
