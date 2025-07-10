<?php

declare(strict_types=1);

namespace App\Models;

use App\ProjectPriority;
use App\ProjectStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class Project extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $fillable = [
        'project_number',
        'name',
        'description',
        'status',
        'priority',
        'contact_id',
        'client_name',
        'client_email',
        'client_phone',
        'project_manager_id',
        'assigned_team_lead_id',
        'start_date',
        'end_date',
        'actual_start_date',
        'actual_end_date',
        'estimated_hours',
        'actual_hours',
        'budget',
        'actual_cost',
        'hourly_rate',
        'billable',
        'location',
        'scope_of_work',
        'requirements',
        'deliverables',
        'progress_percentage',
        'internal_notes',
        'client_notes',
        'milestones',
        'risks',
        'is_template',
        'template_name',
        'custom_fields',
    ];
    
    protected $casts = [
        'status' => ProjectStatus::class,
        'priority' => ProjectPriority::class,
        'start_date' => 'date',
        'end_date' => 'date',
        'actual_start_date' => 'date',
        'actual_end_date' => 'date',
        'budget' => 'decimal:2',
        'actual_cost' => 'decimal:2',
        'hourly_rate' => 'decimal:2',
        'billable' => 'boolean',
        'progress_percentage' => 'integer',
        'milestones' => 'array',
        'risks' => 'array',
        'is_template' => 'boolean',
        'custom_fields' => 'array',
    ];
    
    // Relasjoner
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
    
    public function projectManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'project_manager_id');
    }
    
    public function teamLead(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_team_lead_id');
    }
    
    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class);
    }
    
    // Media Library Collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('project_documents')
            ->acceptsMimeTypes([
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'text/plain',
                'image/jpeg',
                'image/png',
                'image/gif',
            ]);
    }
    
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->performOnCollections('project_documents')
            ->nonQueued();
    }
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNotIn('status', [ProjectStatus::COMPLETED, ProjectStatus::CANCELLED]);
    }
    
    public function scopePlanning($query)
    {
        return $query->where('status', ProjectStatus::PLANNING);
    }
    
    public function scopeInProgress($query)
    {
        return $query->where('status', ProjectStatus::ACTIVE);
    }
    
    public function scopeOverdue($query)
    {
        return $query->where('end_date', '<', now())
                    ->whereNotIn('status', [ProjectStatus::COMPLETED, ProjectStatus::CANCELLED]);
    }
    
    public function scopeByPriority($query, ProjectPriority $priority)
    {
        return $query->where('priority', $priority);
    }
    
    public function scopeByStatus($query, ProjectStatus $status)
    {
        return $query->where('status', $status);
    }
    
    public function scopeTemplates($query)
    {
        return $query->where('is_template', true);
    }
    
    public function scopeProjects($query)
    {
        return $query->where('is_template', false);
    }
    
    // Accessors og helper metoder
    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status->getLabel(),
        );
    }
    
    protected function statusColor(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status->getColor(),
        );
    }
    
    protected function priorityLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->priority->getLabel(),
        );
    }
    
    protected function priorityColor(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->priority->getColor(),
        );
    }
    
    public function isOverdue(): bool
    {
        if (!$this->end_date) {
            return false;
        }
        
        return $this->end_date->isPast() && 
               !in_array($this->status, [ProjectStatus::COMPLETED, ProjectStatus::CANCELLED]);
    }
    
    public function getDurationInDays(): ?int
    {
        if (!$this->start_date || !$this->end_date) {
            return null;
        }
        
        return $this->start_date->diffInDays($this->end_date);
    }
    
    public function getActualDurationInDays(): ?int
    {
        if (!$this->actual_start_date || !$this->actual_end_date) {
            return null;
        }
        
        return $this->actual_start_date->diffInDays($this->actual_end_date);
    }
    
    public function getBudgetUtilization(): ?float
    {
        if (!$this->budget || $this->budget == 0) {
            return null;
        }
        
        return ($this->actual_cost / $this->budget) * 100;
    }
    
    public function getTimeUtilization(): ?float
    {
        if (!$this->estimated_hours || $this->estimated_hours == 0) {
            return null;
        }
        
        return ($this->actual_hours / $this->estimated_hours) * 100;
    }
    
    public function generateProjectNumber(): string
    {
        $year = now()->year;
        $lastProject = self::where('project_number', 'like', "PROJ{$year}-%")
                          ->orderBy('project_number', 'desc')
                          ->first();
        
        if ($lastProject) {
            $lastNumber = (int) substr($lastProject->project_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return sprintf('PROJ%d-%04d', $year, $newNumber);
    }
    
    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->project_number)) {
                $project->project_number = $project->generateProjectNumber();
            }
        });
    }
}
