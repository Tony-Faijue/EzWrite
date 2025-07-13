<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string(column: 'author');
            $table->string('hero_title');
            $table->string('intro');
            $table->json('hero_topics')->nullable();
            $table->json('hero_authors')->nullable();
            $table->string('hero_image')->nullable();
            $table->text('footer_about')->nullable();
            $table->timestamps();
        });

        Schema::create('blog_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained()->cascadeOnDelete();
            $table->string('heading');
            $table->longtext('content');
            $table->json('images')->nullable();
            $table->integer('position')->default(0);
            $table->timestamps();
        });

        Schema::create('blog_related', function (Blueprint $table) {
            $table->foreignId('blog_id')->constrained()->cascadeOnDelete();
            $table->foreignId('related_blog_id')->constrained('blogs')->cascadeOnDelete();
            $table->primary(['blog_id', 'related_blog_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_sections');
        Schema::dropIfExists('blog_related');
    }
};
