<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');            // development | design | marketing
            $table->string('client')->nullable();
            $table->string('summary');
            $table->string('image');               // path inside /public, e.g. /images/portfolio/my-site.jpg
            $table->string('url')->nullable();     // live site link; leave empty if there is none
            $table->json('tags');                  // list of strings
            $table->boolean('is_featured')->default(false); // shown on the homepage
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
