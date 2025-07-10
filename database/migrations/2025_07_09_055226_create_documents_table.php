<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('document_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->string('file_type', 10)->nullable(); // pdf, docx, xlsx, etc.
            $table->bigInteger('file_size')->nullable(); // in bytes
            $table->string('mime_type')->nullable();
            $table->boolean('is_public')->default(false);
            $table->boolean('is_active')->default(true);
            $table->json('metadata')->nullable(); // Additional file metadata
            $table->text('keywords')->nullable(); // For search functionality
            $table->timestamp('last_accessed_at')->nullable();
            $table->integer('download_count')->default(0);
            $table->timestamps();
            
            $table->index(['document_category_id', 'is_active']);
            $table->index(['uploaded_by', 'created_at']);
            $table->index(['is_public', 'is_active']);
        });
    }
};
