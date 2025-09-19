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
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider')->nullable();   // e.g., google, facebook
            $table->string('provider_id')->nullable(); // user ID from provider
            $table->string('google_id')->nullable();   // Google user ID
            $table->string('facebook_id')->nullable(); // Facebook user ID
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['provider', 'provider_id', 'google_id', 'facebook_id']);
        });
    }
};