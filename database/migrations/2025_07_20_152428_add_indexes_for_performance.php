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
        Schema::table('articles', function (Blueprint $table) {
            $table->index('status');
            $table->index('published_at');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('releases', function (Blueprint $table) {
            $table->index('type');
            $table->index('release_date');
        });

        Schema::table('bands', function (Blueprint $table) {
            $table->index('genre');
            $table->index('origin');
        });

        Schema::table('article_tag', function (Blueprint $table) {
            $table->primary(['article_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['published_at']);
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('releases', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropIndex(['release_date']);
        });

        Schema::table('bands', function (Blueprint $table) {
            $table->dropIndex(['genre']);
            $table->dropIndex(['origin']);
        });

        Schema::table('article_tag', function (Blueprint $table) {
            $table->dropPrimary(['article_id', 'tag_id']);
        });
    }
};