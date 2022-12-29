<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('coin_name')->nullable();
            $table->string('coin_balance')->nullable();
            $table->string('coin_image')->nullable();
            $table->string('coin_action')->nullable();
            $table->string('coin_status')->nullable();
            $table->string('coin_address')->nullable();
            $table->string('referral_bonus')->nullable();
            $table->string('loan_balance')->nullable();
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('wallets');
    }
}
