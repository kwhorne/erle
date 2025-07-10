<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class FeatureRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'priority',
        'status',
        'requested_by',
        'assigned_to',
        'reviewed_by',
        'category',
        'tags',
        'business_justification',
        'technical_requirements',
        'acceptance_criteria',
        'estimated_hours',
        'estimated_cost',
        'votes_count',
        'user_votes',
        'user_comments',
        'target_date',
        'completed_date',
        'implementation_notes',
        'version_released',
        'attachments',
        'related_requests',
        'external_reference',
        'rejection_reason',
        'reviewed_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'user_votes' => 'array',
        'attachments' => 'array',
        'related_requests' => 'array',
        'target_date' => 'date',
        'completed_date' => 'date',
        'reviewed_at' => 'datetime',
        'estimated_cost' => 'decimal:2',
    ];

    // Relationships
    public function requestedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Scopes
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeUnderReview(Builder $query): Builder
    {
        return $query->where('status', 'under_review');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function scopeInDevelopment(Builder $query): Builder
    {
        return $query->where('status', 'in_development');
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', 'completed');
    }

    public function scopeHighPriority(Builder $query): Builder
    {
        return $query->whereIn('priority', ['high', 'critical']);
    }

    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    // Accessors
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Pending',
            'under_review' => 'Under Review',
            'approved' => 'Approved',
            'in_development' => 'In Development',
            'testing' => 'Testing',
            'completed' => 'Completed',
            'rejected' => 'Rejected',
            'cancelled' => 'Cancelled',
            default => 'Unknown',
        };
    }

    public function getPriorityLabelAttribute(): string
    {
        return match ($this->priority) {
            'low' => 'Low',
            'normal' => 'Normal',
            'high' => 'High',
            'critical' => 'Critical',
            default => 'Unknown',
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'feature' => 'Feature',
            'enhancement' => 'Enhancement',
            'bug_fix' => 'Bug Fix',
            'integration' => 'Integration',
            'performance' => 'Performance',
            'ui_ux' => 'UI/UX',
            default => 'Unknown',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'under_review' => 'info',
            'approved' => 'success',
            'in_development' => 'primary',
            'testing' => 'secondary',
            'completed' => 'success',
            'rejected' => 'danger',
            'cancelled' => 'gray',
            default => 'gray',
        };
    }

    public function getPriorityColorAttribute(): string
    {
        return match ($this->priority) {
            'low' => 'gray',
            'normal' => 'primary',
            'high' => 'warning',
            'critical' => 'danger',
            default => 'gray',
        };
    }

    // Methods
    public function addVote(int $userId): void
    {
        $votes = $this->user_votes ?? [];
        if (!in_array($userId, $votes)) {
            $votes[] = $userId;
            $this->user_votes = $votes;
            $this->votes_count = count($votes);
            $this->save();
        }
    }

    public function removeVote(int $userId): void
    {
        $votes = $this->user_votes ?? [];
        $votes = array_filter($votes, fn($id) => $id !== $userId);
        $this->user_votes = array_values($votes);
        $this->votes_count = count($votes);
        $this->save();
    }

    public function hasVotedBy(int $userId): bool
    {
        return in_array($userId, $this->user_votes ?? []);
    }

    public function markAsReviewed(int $reviewerId): void
    {
        $this->reviewed_by = $reviewerId;
        $this->reviewed_at = Carbon::now();
        $this->save();
    }

    public function approve(): void
    {
        $this->status = 'approved';
        $this->save();
    }

    public function reject(string $reason): void
    {
        $this->status = 'rejected';
        $this->rejection_reason = $reason;
        $this->save();
    }

    public function complete(): void
    {
        $this->status = 'completed';
        $this->completed_date = Carbon::now();
        $this->save();
    }
}
