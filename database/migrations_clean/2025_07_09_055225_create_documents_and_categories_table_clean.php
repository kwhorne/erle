<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        // Document Categories
        Schema::create('document_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('color', 7)->default('#3B82F6'); // Hex color code
            $table->string('icon', 50)->default('heroicon-o-folder');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            // Indekser
            $table->index(['is_active', 'sort_order']);
        });

        // Documents
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('document_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            
            // Fil informasjon
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type', 10)->nullable(); // pdf, docx, xlsx, etc.
            $table->bigInteger('file_size')->nullable(); // in bytes
            $table->string('mime_type')->nullable();
            $table->string('file_hash')->nullable(); // For duplicate detection
            
            // Tilgangskontroll
            $table->boolean('is_public')->default(false);
            $table->boolean('is_active')->default(true);
            $table->json('access_permissions')->nullable(); // For fine-grained access control
            
            // Metadata og søk
            $table->json('metadata')->nullable(); // Additional file metadata
            $table->text('keywords')->nullable(); // For search functionality
            $table->text('extracted_text')->nullable(); // For full-text search
            
            // Statistikk
            $table->timestamp('last_accessed_at')->nullable();
            $table->integer('download_count')->default(0);
            $table->integer('view_count')->default(0);
            
            // Versjonering
            $table->string('version', 10)->default('1.0');
            $table->foreignId('parent_document_id')->nullable()->constrained('documents')->onDelete('cascade');
            
            $table->timestamps();
            
            // Indekser for ytelse
            $table->index(['document_category_id', 'is_active']);
            $table->index(['uploaded_by', 'created_at']);
            $table->index(['is_public', 'is_active']);
            $table->index(['file_hash']); // For duplicate detection
            $table->index(['parent_document_id']); // For versioning
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
        Schema::dropIfExists('document_categories');
    }
};
