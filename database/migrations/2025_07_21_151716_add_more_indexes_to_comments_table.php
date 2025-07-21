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
        Schema::table('comments', function (Blueprint $table) {
            $table->index('article_id');
            $table->index('created_at');
            $table->index(['article_id', 'status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex(['article_id']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['comments_article_id_status_created_at_index']); // Laravel's default name for composite index
        });
    }
};