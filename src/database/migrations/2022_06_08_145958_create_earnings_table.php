<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->string('amount_invested')->nullable();
            $table->string('plan_name')->nullable();
            $table->string('earned_amount')->nullable();
            $table->datetime('date_invested')->nullable();
            $table->datetime('end_date')->nullable();
            // $table->integer('total_return')->nullable();
            $table->string('expected_return')->nullable();
            $table->datetime('nextprofit_date')->nullable();
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade")->onUpdate("cascade");
            $table->string('invested_by')->nullable();
            $table->string('counter')->nullable();
            $table->string('earnings_action')->nullable();
            $table->integer('expired')->nullable();
            $table->integer('reinvest')->nullable();
            $table->string('email')->nullable();
            $table->string('method')->nullable();
             $table->foreignId('plan_id')->constrained('plans')->onDelete("cascade")->onUpdate("cascade");

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
        Schema::dropIfExists('earnings');
    }
}
