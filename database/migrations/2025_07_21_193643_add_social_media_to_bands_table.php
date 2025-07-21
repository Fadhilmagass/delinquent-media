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
        Schema::table('bands', function (Blueprint $table) {
            $table->string('website_url')->nullable()->after('bio');
            $table->string('bandcamp_url')->nullable()->after('website_url');
            $table->string('spotify_url')->nullable()->after('bandcamp_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bands', function (Blueprint $table) {
            $table->string('website_url')->nullable()->after('bio');
            $table->string('bandcamp_url')->nullable()->after('website_url');
            $table->string('spotify_url')->nullable()->after('bandcamp_url');
        });
    }
};
