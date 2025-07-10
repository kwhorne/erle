<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            // Grunnleggende prosjektinformasjon
            $table->string('project_number')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', ['planning', 'active', 'on_hold', 'completed', 'cancelled', 'maintenance'])->default('planning');
            $table->enum('priority', ['low', 'normal', 'high', 'urgent', 'critical'])->default('normal');
            
            // Relasjon til kunde/kontakt
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->onDelete('set null');
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();
            
            // Prosjektledelse
            $table->foreignId('project_manager_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('assigned_team_lead_id')->nullable()->constrained('users')->onDelete('set null');
            
            // Tidsplan
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('actual_start_date')->nullable();
            $table->date('actual_end_date')->nullable();
            $table->integer('estimated_hours')->nullable();
            $table->integer('actual_hours')->nullable();
            
            // Økonomi
            $table->decimal('budget', 15, 2)->nullable();
            $table->decimal('actual_cost', 15, 2)->nullable();
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->boolean('billable')->default(true);
            
            // Lokasjon og detaljer
            $table->string('location')->nullable();
            $table->text('scope_of_work')->nullable();
            $table->text('requirements')->nullable();
            $table->text('deliverables')->nullable();
            
            // Fremdrift
            $table->integer('progress_percentage')->default(0);
            $table->text('internal_notes')->nullable();
            $table->text('client_notes')->nullable();
            $table->json('milestones')->nullable();
            $table->json('risks')->nullable();
            
            // Metadata
            $table->boolean('is_template')->default(false);
            $table->string('template_name')->nullable();
            $table->json('custom_fields')->nullable();
            
            $table->timestamps();
            
            // Indekser for ytelse
            $table->index(['status', 'priority']);
            $table->index(['start_date', 'end_date']);
            $table->index(['project_manager_id']);
            $table->index(['contact_id']);
            $table->index(['is_template']);
            $table->index(['project_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
