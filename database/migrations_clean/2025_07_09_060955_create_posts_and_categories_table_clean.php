<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        // Post Categories
        Schema::create('post_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->string('color', 7)->default('#3B82F6'); // Hex color code
            $table->string('icon', 50)->default('heroicon-o-tag');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            
            // SEO felter
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            
            // Hierarki support
            $table->foreignId('parent_id')->nullable()->constrained('post_categories')->onDelete('cascade');
            
            $table->timestamps();
            
            // Indekser
            $table->index(['is_active', 'sort_order']);
            $table->index(['is_featured', 'sort_order']);
            $table->index(['parent_id']);
            $table->index(['slug']);
        });

        // Posts
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            
            // Media
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable(); // For multiple images
            
            // Relasjoner
            $table->foreignId('post_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            
            // Status og publisering
            $table->enum('status', ['draft', 'published', 'archived', 'scheduled'])->default('draft');
            $table->enum('visibility', ['public', 'private', 'password'])->default('public');
            $table->string('password')->nullable(); // For password protected posts
            $table->timestamp('published_at')->nullable();
            $table->timestamp('scheduled_at')->nullable();
            
            // Funksjoner
            $table->boolean('is_featured')->default(false);
            $table->boolean('allow_comments')->default(true);
            $table->boolean('is_sticky')->default(false); // For pinned posts
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->json('og_meta')->nullable(); // Open Graph metadata
            
            // Statistikk
            $table->integer('view_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->integer('share_count')->default(0);
            
            // Språk og lokalisering
            $table->string('language', 5)->default('nb');
            $table->foreignId('translated_from')->nullable()->constrained('posts')->onDelete('set null');
            
            // Innholdstype
            $table->enum('post_type', ['article', 'news', 'tutorial', 'case_study', 'announcement'])->default('article');
            
            // Avanserte funksjoner
            $table->json('custom_fields')->nullable();
            $table->json('reading_time')->nullable(); // Estimated reading time
            $table->text('audio_transcript')->nullable(); // For podcast/audio posts
            
            $table->timestamps();
            
            // Indekser for ytelse
            $table->index(['status', 'published_at']);
            $table->index(['post_category_id', 'status']);
            $table->index(['author_id', 'created_at']);
            $table->index(['is_featured', 'published_at']);
            $table->index(['language', 'status']);
            $table->index(['post_type', 'status']);
            $table->index(['visibility', 'status']);
            $table->index(['slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('post_categories');
    }
};
