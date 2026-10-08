<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('category');            // development | design | marketing
            $table->string('icon');                // key used by ServiceIcon.vue
            $table->string('summary');             // one line, shown on cards
            $table->text('description');           // shown on the detail page
            $table->json('deliverables');          // list of strings
            $table->unsignedInteger('starting_price'); // PKR
            $table->string('timeline');            // e.g. "2–4 weeks"
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
