<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            
            // Grunnleggende informasjon
            $table->string('type'); // ContactType enum
            $table->string('name');
            $table->string('organization')->nullable();
            $table->string('organization_number', 20)->nullable();
            $table->string('title')->nullable(); // Stilling
            
            // Kontaktinformasjon
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('website')->nullable();
            
            // Adresse
            $table->text('address')->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            
            // CRM data
            $table->text('notes')->nullable();
            $table->json('contact_persons')->nullable(); // JSON for flere kontaktpersoner
            $table->string('source')->nullable(); // Hvor kom kontakten fra
            $table->decimal('value', 12, 2)->nullable(); // Potensiell/faktisk verdi
            $table->date('last_contact_date')->nullable();
            $table->date('next_followup_date')->nullable();
            $table->string('status')->default('active'); // active, inactive, archived
            
            // Sosiale medier
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            
            // Metadata
            $table->json('tags')->nullable(); // For kategorisering
            $table->unsignedBigInteger('assigned_to')->nullable(); // Ansvarlig bruker
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            
            $table->timestamps();
            
            // Indekser
            $table->index(['type', 'status']);
            $table->index('organization_number');
            $table->index('email');
            $table->index('assigned_to');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
