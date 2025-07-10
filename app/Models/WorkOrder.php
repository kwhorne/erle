<?php

declare(strict_types=1);

namespace App\Models;

use App\WorkOrderStatus;
use App\WorkOrderPriority;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class WorkOrder extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'work_order_number',
        'title',
        'description',
        'status',
        'priority',
        'contact_id',
        'project_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'assigned_to',
        'due_date',
        'started_at',
        'completed_at',
        'estimated_hours',
        'actual_hours',
        'location',
        'equipment',
        'equipment_serial',
        'estimated_cost',
        'actual_cost',
        'billable',
        'internal_notes',
        'customer_notes',
        'checklist',
        'parts_used',
    ];

    protected $casts = [
        'status' => WorkOrderStatus::class,
        'priority' => WorkOrderPriority::class,
        'due_date' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'estimated_cost' => 'decimal:2',
        'actual_cost' => 'decimal:2',
        'billable' => 'boolean',
        'checklist' => 'array',
        'parts_used' => 'array',
    ];

    // Relasjoner
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
    
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Media Library
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('workorder_attachments')
            ->acceptsMimeTypes([
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'text/plain',
                'image/jpeg',
                'image/png',
                'image/gif'
            ])
            ->useDisk('public')
            ->usePath('workorders');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNotIn('status', [WorkOrderStatus::COMPLETED, WorkOrderStatus::CANCELLED]);
    }

    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())
                    ->whereNotIn('status', [WorkOrderStatus::COMPLETED, WorkOrderStatus::CANCELLED]);
    }

    public function scopeByPriority($query, WorkOrderPriority $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeByStatus($query, WorkOrderStatus $status)
    {
        return $query->where('status', $status);
    }

    // Accessors og Mutators
    protected function workOrderNumber(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value,
            set: fn (?string $value) => $value ?? $this->generateWorkOrderNumber(),
        );
    }

    // Helper metoder
    private function generateWorkOrderNumber(): string
    {
        $year = now()->year;
        $lastOrder = static::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();
            
        $nextNumber = $lastOrder ? (int) substr($lastOrder->work_order_number, -4) + 1 : 1;
        
        return 'WO' . $year . str_pad((string) $nextNumber, 4, '0', STR_PAD_LEFT);
    }

    public function getStatusLabel(): string
    {
        return $this->status->getLabel();
    }

    public function getStatusColor(): string
    {
        return $this->status->getColor();
    }

    public function getPriorityLabel(): string
    {
        return $this->priority->getLabel();
    }

    public function getPriorityColor(): string
    {
        return $this->priority->getColor();
    }

    public function isOverdue(): bool
    {
        return $this->due_date &&
            $this->due_date < now() &&
            !in_array($this->status, [WorkOrderStatus::COMPLETED, WorkOrderStatus::CANCELLED]);
    }

    public function getDurationInHours(): ?int
    {
        if (!$this->started_at || !$this->completed_at) {
            return null;
        }
        
        return (int) $this->started_at->diffInHours($this->completed_at);
    }
}
