<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        // Media table (for file uploads)
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->string('uuid')->nullable()->unique();
            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('disk');
            $table->string('conversions_disk')->nullable();
            $table->unsignedBigInteger('size');
            $table->json('manipulations');
            $table->json('custom_properties');
            $table->json('generated_conversions');
            $table->json('responsive_images');
            $table->unsignedInteger('order_column')->nullable();
            $table->nullableTimestamps();
            
            $table->index(['model_type', 'model_id']);
            $table->index(['collection_name']);
        });

        // Tags table
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('slug');
            $table->string('type')->nullable();
            $table->integer('order_column')->nullable();
            $table->timestamps();
            
            $table->index(['type']);
        });

        // Taggables (pivot table)
        Schema::create('taggables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->morphs('taggable');
            $table->timestamps();
            
            $table->unique(['tag_id', 'taggable_id', 'taggable_type']);
        });

        // Notifications table
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            
            $table->index(['notifiable_type', 'notifiable_id']);
        });

        // Employees table
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            
            // Job information
            $table->string('job_title');
            $table->string('department');
            $table->enum('employment_type', ['full_time', 'part_time', 'contract', 'intern', 'consultant'])->default('full_time');
            $table->enum('status', ['active', 'inactive', 'terminated', 'on_leave'])->default('active');
            
            // Dates
            $table->date('hire_date');
            $table->date('termination_date')->nullable();
            $table->date('birth_date')->nullable();
            
            // Salary information
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('salary_currency', 3)->default('NOK');
            $table->enum('salary_period', ['hourly', 'monthly', 'yearly'])->default('yearly');
            
            // Address
            $table->string('address')->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('city')->nullable();
            $table->string('country')->default('Norway');
            
            // Emergency contact
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            
            // Manager relationship
            $table->foreignId('manager_id')->nullable()->constrained('employees')->onDelete('set null');
            
            // Additional information
            $table->text('bio')->nullable();
            $table->text('skills')->nullable();
            $table->json('certifications')->nullable();
            $table->string('photo')->nullable();
            
            $table->timestamps();
            
            // Indekser
            $table->index(['status', 'department']);
            $table->index(['manager_id']);
            $table->index(['employee_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('taggables');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('media');
    }
};
