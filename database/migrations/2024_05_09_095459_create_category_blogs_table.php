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
        Schema::create('blogs_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('category_id');
            $table->unsignedBiginteger('blogs_id');

            $table->foreign('category_id')->references('id')
                 ->on('categories')->onDelete('cascade');
            $table->foreign('blogs_id')->references('id')
                ->on('blogs')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_blogs');
    }
};
