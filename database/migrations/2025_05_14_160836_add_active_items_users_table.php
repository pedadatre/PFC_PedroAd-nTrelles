<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('active_avatar_id')->nullable()->constrained('items')->nullOnDelete();
            $table->foreignId('active_badge_id')->nullable()->constrained('items')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['active_avatar_id']);
            $table->dropForeign(['active_badge_id']);
            $table->dropColumn(['active_avatar_id', 'active_badge_id']);
        });
    }
    
};