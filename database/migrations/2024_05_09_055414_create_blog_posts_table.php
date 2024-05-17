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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();  
            $table->string('short_description')->nullable();                     
            $table->longText('body')->nullable();          
            $table->string('image')->nullable();
            $table->datetime('published_at')->nullable();
            $table->integer('sort')->nullable();
            $table->boolean('status')->default(true);            
            $table->string('author_name')->nullable();  
            $table->unsignedBigInteger('user_id')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
