<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->string('job_title')->nullable();
            $table->string('department')->nullable();
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('Norge');
            $table->date('birth_date')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->json('emergency_contact')->nullable();
            $table->timestamp('last_login_at')->nullable();
        });
    }
    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'bio', 'job_title', 'department', 'location',
                'address', 'city', 'postal_code', 'country', 'birth_date',
                'linkedin_url', 'twitter_url', 'emergency_contact', 'last_login_at'
            ]);
        });
    }
};
