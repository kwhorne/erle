<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('feature_requests', function (Blueprint $table) {
            $table->id();
            
            // Grunnleggende informasjon
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['feature', 'enhancement', 'bug_fix', 'integration', 'performance', 'ui_ux']);
            $table->enum('priority', ['low', 'normal', 'high', 'critical'])->default('normal');
            $table->enum('status', ['pending', 'under_review', 'approved', 'in_development', 'testing', 'completed', 'rejected', 'cancelled'])->default('pending');
            
            // Bruker som sendte forespørselen
            $table->foreignId('requested_by')->constrained('users')->onDelete('cascade');
            
            // Tildeling og håndtering
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            
            // Kategorisering
            $table->string('category')->nullable(); // UI, Backend, Mobile, etc.
            $table->json('tags')->nullable(); // Fleksible tags
            
            // Detaljer
            $table->text('business_justification')->nullable();
            $table->text('technical_requirements')->nullable();
            $table->text('acceptance_criteria')->nullable();
            $table->integer('estimated_hours')->nullable();
            $table->decimal('estimated_cost', 10, 2)->nullable();
            
            // Brukerfeedback
            $table->integer('votes_count')->default(0);
            $table->json('user_votes')->nullable(); // Hvem har stemt
            $table->text('user_comments')->nullable();
            
            // Implementering
            $table->date('target_date')->nullable();
            $table->date('completed_date')->nullable();
            $table->text('implementation_notes')->nullable();
            $table->string('version_released')->nullable();
            
            // Vedlegg og referanser
            $table->json('attachments')->nullable();
            $table->json('related_requests')->nullable(); // Relaterte forespørsler
            $table->string('external_reference')->nullable(); // GitHub issue, etc.
            
            // Avvisning/avlysning
            $table->text('rejection_reason')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            
            $table->timestamps();
            
            // Indekser for ytelse
            $table->index(['status', 'priority']);
            $table->index(['requested_by', 'created_at']);
            $table->index(['assigned_to', 'status']);
            $table->index(['type', 'status']);
            $table->index(['category', 'status']);
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('feature_requests');
    }
};
