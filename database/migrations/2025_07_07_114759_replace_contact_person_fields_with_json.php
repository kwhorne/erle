<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Legg til nytt JSON felt for kontaktpersoner
            $table->json('contact_persons')->nullable()->after('notes');
            
            // Fjern de gamle individuelle feltene
            $table->dropColumn([
                'contact_person_name',
                'contact_person_title',
                'contact_person_email', 
                'contact_person_phone',
            ]);
        });
    }
    
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Legg tilbake de gamle feltene
            $table->string('contact_person_name')->nullable()->after('notes');
            $table->string('contact_person_title')->nullable()->after('contact_person_name');
            $table->string('contact_person_email')->nullable()->after('contact_person_title');
            $table->string('contact_person_phone', 20)->nullable()->after('contact_person_email');
            
            // Fjern JSON feltet
            $table->dropColumn('contact_persons');
        });
    }
};
