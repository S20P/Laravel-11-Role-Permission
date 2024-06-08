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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('blog_id')->index();
            $table->unsignedBiginteger('user_id')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('email');
            $table->text('comment');
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
        Schema::dropIfExists('comments');
    }
};
