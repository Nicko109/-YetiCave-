<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price_bet');
            $table->softDeletes();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lot_id');

            $table->index('user_id', 'bets_user_idx');
            $table->index('lot_id', 'bets_lot_idx');

            $table->foreign('user_id', 'bets_user_fk')->on('users')->references('id');
            $table->foreign('lot_id', 'bets_lot_fk')->on('lots')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bets');
    }
};
