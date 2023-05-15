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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->integer('user_id');
            $table->string('manufacturer')->nullable();
            $table->tinyInteger('event')->nullable();
            $table->tinyInteger('dominant_hand')->nullable();
            $table->string('model')->nullable();
            $table->tinyInteger('available')->nullable();
            $table->tinyInteger('sale')->nullable();
            $table->string('similar_products')->nullable();
            $table->string('store')->nullable();
            $table->integer('recommends')->nullable();
            $table->string('free_review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
