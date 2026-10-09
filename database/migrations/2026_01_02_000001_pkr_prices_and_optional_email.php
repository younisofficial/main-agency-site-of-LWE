<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
 * - Prices can now be a range in PKR: price = lowest, price_max = highest (empty = one fixed price).
 * - Email on the contact form is optional (many clients only use WhatsApp), phone is required in the form,
 *   and the message box is optional.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->unsignedInteger('price_max')->nullable()->after('price');
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->text('message')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->dropColumn('price_max');
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('email')->nullable(false)->change();
            $table->text('message')->nullable(false)->change();
        });
    }
};
