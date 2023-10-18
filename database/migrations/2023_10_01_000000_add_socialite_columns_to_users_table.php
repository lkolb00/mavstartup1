<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Fortify\Fortify;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider')->after('password')->nullable();
            $table->string('provider_id')->after('provider')->nullable();
            $table->string('provider_token')->after('provider_id')->nullable();
            $table->string('provider_token_secret')->after('provider_token')->nullable();
            $table->string('provider_refresh_token')->after('provider_token_secret')->nullable();
            $table->string('provider_expires_in')->after('provider_refresh_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(array_merge([ 'provider', 'provider_id', 'provider_token',
                'provider_token_secret', 'provider_refresh_token', 'provider_expires_in',
            ]));
        });
    }
};
