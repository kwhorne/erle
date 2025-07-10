<?php

declare(strict_types=1);

namespace App\Models;

use App\ContactType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Contact extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'type',
        'name',
        'organization',
        'organization_number',
        'title',
        'email',
        'phone',
        'mobile',
        'website',
        'address',
        'postal_code',
        'city',
        'country',
        'notes',
        'source',
        'value',
        'last_contact_date',
        'next_followup_date',
        'assigned_to',
        'status',
        'tags',
        'linkedin',
        'twitter',
        'contact_persons',
    ];

    protected $casts = [
        'type' => ContactType::class,
        'tags' => 'array',
        'contact_persons' => 'array',
        'value' => 'decimal:2',
        'last_contact_date' => 'date',
        'next_followup_date' => 'date',
    ];

    // Relasjoner
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class);
    }

    // Accessors og Mutators
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->organization 
                ? "{$this->name} ({$this->organization})"
                : $this->name
        );
    }

    protected function displayAddress(): Attribute
    {
        return Attribute::make(
            get: function () {
                $parts = array_filter([
                    $this->address,
                    $this->postal_code ? "{$this->postal_code} {$this->city}" : $this->city,
                    $this->country
                ]);
                return implode(', ', $parts);
            }
        );
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOfType($query, ContactType $type)
    {
        return $query->where('type', $type);
    }

    public function scopeCustomers($query)
    {
        return $query->where('type', ContactType::CUSTOMER);
    }

    public function scopeSuppliers($query)
    {
        return $query->where('type', ContactType::SUPPLIER);
    }

    public function scopePartners($query)
    {
        return $query->where('type', ContactType::PARTNER);
    }

    public function scopePotentialCustomers($query)
    {
        return $query->where('type', ContactType::POTENTIAL_CUSTOMER);
    }

    public function scopeNeedsFollowup($query)
    {
        return $query->whereNotNull('next_followup_date')
                    ->where('next_followup_date', '<=', now());
    }

    // Media Library
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('contactdocs')
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
            ->usePath('contactdocs');
    }

    // Metoder
    public function getTypeLabel(): string
    {
        return $this->type->getLabel();
    }

    public function getTypeColor(): string
    {
        return $this->type->getColor();
    }
}
