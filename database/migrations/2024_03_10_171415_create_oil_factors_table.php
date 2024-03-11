<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOilFactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oil_factors', function (Blueprint $table) {
            $table->id();
            $table->string('parameter');
            $table->float('weight', 10, 5);
            $table->float('score1', 10, 5);
            $table->float('score2', 10, 5);
            $table->float('score3', 10, 5);
            $table->float('score4', 10, 5);
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
        Schema::dropIfExists('oil_factors');
    }
}
