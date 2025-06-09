<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->json('ingredients');
            $table->text('instructions');
            $table->string('image_url');
            $table->string('cuisine_type')->nullable();
            $table->string('difficulty')->nullable();
            $table->integer('prep_time')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};