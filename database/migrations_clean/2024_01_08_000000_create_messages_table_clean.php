<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            
            // Sender/Recipient
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('recipient_id')->constrained('users')->onDelete('cascade');
            
            // Message content
            $table->string('subject');
            $table->text('body');
            $table->json('attachments')->nullable(); // File attachments
            
            // Message properties
            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
            $table->enum('status', ['draft', 'sent', 'delivered', 'read', 'archived'])->default('sent');
            $table->enum('message_type', ['direct', 'broadcast', 'system', 'notification'])->default('direct');
            
            // Threading support
            $table->foreignId('thread_id')->nullable()->constrained('messages')->onDelete('cascade');
            $table->foreignId('reply_to')->nullable()->constrained('messages')->onDelete('cascade');
            
            // Timestamps
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            
            // Tracking
            $table->boolean('is_starred')->default(false);
            $table->boolean('is_important')->default(false);
            $table->json('labels')->nullable(); // For organizing messages
            
            // Delivery tracking
            $table->string('delivery_status')->nullable();
            $table->text('delivery_notes')->nullable();
            
            // Security
            $table->boolean('is_encrypted')->default(false);
            $table->string('encryption_key')->nullable();
            
            $table->timestamps();
            
            // Indekser for ytelse
            $table->index(['recipient_id', 'read_at']);
            $table->index(['sender_id', 'created_at']);
            $table->index(['status', 'created_at']);
            $table->index(['message_type', 'status']);
            $table->index(['thread_id', 'created_at']);
            $table->index(['priority', 'status']);
            $table->index(['is_starred', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
