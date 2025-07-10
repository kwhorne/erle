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
            
            // Relasjoner
            $table->foreignId('contact_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            
            // Kunde/Kontakt informasjon
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            
            // Tildeling
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            
            // Tidsplanlegging
            $table->datetime('due_date')->nullable();
            $table->datetime('started_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->integer('estimated_hours')->nullable();
            $table->integer('actual_hours')->nullable();
            
            // Lokasjon/Utstyr
            $table->string('location')->nullable();
            $table->string('equipment')->nullable();
            $table->string('equipment_serial')->nullable();
            
            // Økonomi
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->decimal('actual_cost', 10, 2)->nullable();
            $table->boolean('billable')->default(true);
            
            // Tilleggsinformasjon
            $table->text('internal_notes')->nullable();
            $table->text('customer_notes')->nullable();
            $table->json('checklist')->nullable();
            
            $table->timestamps();
            
            // Indekser for ytelse
            $table->index(['status', 'priority']);
            $table->index(['assigned_to']);
            $table->index(['contact_id']);
            $table->index(['project_id']);
            $table->index(['due_date']);
            $table->index(['work_order_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
