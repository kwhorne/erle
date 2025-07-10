<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('work_order_number')->unique();
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['pending', 'in_progress', 'waiting_customer', 'waiting_parts', 'testing', 'completed', 'cancelled', 'on_hold'])->default('pending');
            $table->enum('priority', ['low', 'normal', 'high', 'urgent', 'critical'])->default('normal');
            
            // Customer/Contact information
            $table->foreignId('contact_id')->nullable()->constrained()->onDelete('set null');
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            
            // Assignment
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            
            // Timing
            $table->datetime('due_date')->nullable();
            $table->datetime('started_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->integer('estimated_hours')->nullable();
            $table->integer('actual_hours')->nullable();
            
            // Location/Equipment
            $table->string('location')->nullable();
            $table->string('equipment')->nullable();
            $table->string('equipment_serial')->nullable();
            
            // Financial
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->decimal('actual_cost', 10, 2)->nullable();
            $table->boolean('billable')->default(true);
            
            // Additional info
            $table->text('internal_notes')->nullable();
            $table->text('customer_notes')->nullable();
            $table->json('checklist')->nullable();
            $table->json('parts_used')->nullable();
            
            // Timestamps
            $table->timestamps();
            
            // Indexes
            $table->index(['status', 'priority']);
            $table->index(['due_date']);
            $table->index(['assigned_to']);
            $table->index(['contact_id']);
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
