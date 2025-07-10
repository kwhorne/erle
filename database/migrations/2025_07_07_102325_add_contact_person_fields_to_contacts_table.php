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
            $table->string('contact_person_name')->nullable()->after('notes');
            $table->string('contact_person_title')->nullable()->after('contact_person_name');
            $table->string('contact_person_email')->nullable()->after('contact_person_title');
            $table->string('contact_person_phone', 20)->nullable()->after('contact_person_email');
        });
    }
    
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn([
                'contact_person_name',
                'contact_person_title', 
                'contact_person_email',
                'contact_person_phone',
            ]);
        });
    }
};
