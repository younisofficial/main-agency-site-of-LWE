<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
 * kind:     'project' = our own work, 'example' = a website from the market shown as a design idea
 * industry: which price category it belongs to (business, school, restaurant, store, realestate, rental, pharmacy)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('kind')->default('project')->after('category');
            $table->string('industry')->nullable()->after('kind');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['kind', 'industry']);
        });
    }
};
