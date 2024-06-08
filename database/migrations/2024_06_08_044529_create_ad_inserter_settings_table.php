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
        Schema::create('ad_inserter_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->index();
            $table->longText('value');   
            
            // ENUM
            $table->enum('page_type', [
                'post', 
                'home_page', 
                'category_page', 
                'static_page', 
                'search_page', 
                'tag_archive_page'
            ])->index();

            $table->enum('position', [
                'before_post', 
                'after_post', 
                'before_content', 
                'after_content', 
                'before_paragraph', 
                'after_paragraph', 
                'before_image', 
                'after_image', 
                'before_footer', 
                'after_footer', 
                'before_comments', 
                'between_comments', 
                'after_comments'
            ])->index();

           
            $table->enum('alignment',[
                'Left', 
                'Center', 
                'Right', 
                'Float left', 
                'Float right', 
                'No wrapping', 
                'Custom CSS'
            ])->default('Left');

            $table->boolean('status')->default(true);  
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_inserter_settings');
    }
};
