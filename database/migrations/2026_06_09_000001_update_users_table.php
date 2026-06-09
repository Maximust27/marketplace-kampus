<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar_url', 500)->nullable()->after('role');
            $table->string('phone', 20)->nullable()->after('avatar_url');
            $table->string('location', 255)->nullable()->after('phone');
            $table->boolean('is_verified_seller')->default(false)->after('location');
            $table->timestamp('last_seen_at')->nullable()->after('is_verified_seller');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar_url', 'phone', 'location', 'is_verified_seller', 'last_seen_at']);
        });
    }
};
