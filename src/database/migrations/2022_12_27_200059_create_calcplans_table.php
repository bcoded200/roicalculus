<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalcplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('calcplans', function (Blueprint $table) {
            $table->id();
            $table->string('bundle')->nullable();
            $table->string('plan')->nullable();
            $table->integer('minimium')->nullable();
            $table->integer('maximium')->nullable();
            $table->string('percentage')->nullable();
            $table->string('referal_bonus')->nullable();
            $table->string('commission')->nullable();
            $table->string('main_fee')->nullable();
            $table->string('duration')->nullable();
            $table->string('payout')->nullable();
            $table->string('th')->nullable();
            $table->integer('no_of_times')->nullable();
            $table->string('max_reinvest')->nullable();
            $table->string('planavatar')->nullable();
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
        Schema::dropIfExists('calcplans');
    }
}

