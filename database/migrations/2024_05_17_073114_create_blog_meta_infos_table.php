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
        Schema::create('blog_meta_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('blog_id');
            $table->string('meta_key');
            $table->longText('meta_value');           
            $table->integer('sort')->nullable();
            $table->boolean('status')->default(true);  
            
            $table->foreign('blog_id')->references('id')
                ->on('blogs')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_meta_infos');
    }
};
