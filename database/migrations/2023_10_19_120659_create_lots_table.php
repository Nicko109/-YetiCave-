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
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('lot_description');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedSmallInteger('status')->default(0);
            $table->unsignedBigInteger('start_price');
            $table->dateTime('date_finish');
            $table->unsignedBigInteger('step');

            $table->softDeletes();

            $table->timestamps();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');


            $table->index('category_id', 'lot_category_idx');
            $table->foreign('category_id', 'lot_category_fk')->on('categories')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lots');
    }
};
