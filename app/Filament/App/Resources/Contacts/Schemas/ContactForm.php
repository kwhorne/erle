<?php

namespace App\Filament\App\Resources\Contacts\Schemas;

use App\ContactType;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Support\Enums\IconPosition;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->schema([
                Tabs::make('ContactTabs')
                    ->columnSpan(2)
                    ->tabs([
                        Tab::make(__('contacts.tabs.basic_information'))
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                TextInput::make('organization')
                                    ->label(__('contacts.fields.organization'))
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-building-office')
                                    ->columnSpanFull(),
                                    
                                TextInput::make('address')
                                    ->label(__('contacts.fields.address'))
                                    ->maxLength(500)
                                    ->prefixIcon('heroicon-o-map-pin')
                                    ->columnSpanFull(),
                                    
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('postal_code')
                                            ->label(__('contacts.fields.postal_code'))
                                            ->maxLength(10)
                                            ->prefixIcon('heroicon-o-hashtag'),
                                            
                                        TextInput::make('city')
                                            ->label(__('contacts.fields.city'))
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-building-office-2'),
                                            
                                        TextInput::make('organization_number')
                                            ->label(__('contacts.fields.organization_number'))
                                            ->maxLength(20)
                                            ->prefixIcon('heroicon-o-identification')
                                            ->placeholder(__('contacts.placeholders.organization_number')),
                                    ]),
                                    
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('email')
                                            ->label(__('contacts.fields.email'))
                                            ->email()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-envelope'),
                                            
                                        TextInput::make('phone')
                                            ->label(__('contacts.fields.phone'))
                                            ->tel()
                                            ->maxLength(20)
                                            ->prefixIcon('heroicon-o-phone'),
                                            
                                        TextInput::make('website')
                                            ->label(__('contacts.fields.website'))
                                            ->url()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-globe-alt')
                                            ->placeholder(__('contacts.placeholders.website')),
                                    ]),
                                    
                                TextInput::make('country')
                                    ->label(__('contacts.fields.country'))
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-flag')
                                    ->default('Norge')
                                    ->columnSpanFull(),
                                    
                                Textarea::make('notes')
                                    ->label(__('contacts.fields.notes'))
                                    ->rows(4)
                                    ->maxLength(1000)
                                    ->placeholder(__('contacts.placeholders.notes'))
                                    ->columnSpanFull(),
                            ]),
                            
                        Tab::make(__('contacts.tabs.contact_persons'))
                            ->icon('heroicon-o-users')
                            ->schema([
                                Repeater::make('contact_persons')
                                    ->label(__('contacts.tabs.contact_persons'))
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label(__('contacts.fields.name'))
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->prefixIcon('heroicon-o-user'),
                                                    
                                                TextInput::make('title')
                                                    ->label(__('contacts.fields.title'))
                                                    ->maxLength(255)
                                                    ->prefixIcon('heroicon-o-briefcase'),
                                            ]),
                                            
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('email')
                                                    ->label(__('contacts.fields.email'))
                                                    ->email()
                                                    ->maxLength(255)
                                                    ->prefixIcon('heroicon-o-envelope'),
                                                    
                                                TextInput::make('phone')
                                                    ->label(__('contacts.fields.phone'))
                                                    ->tel()
                                                    ->maxLength(20)
                                                    ->prefixIcon('heroicon-o-phone'),
                                            ]),
                                            
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('linkedin')
                                                    ->label(__('contacts.fields.linkedin'))
                                                    ->url()
                                                    ->maxLength(255)
                                                    ->prefixIcon('heroicon-o-link')
                                                    ->placeholder(__('contacts.placeholders.linkedin')),
                                                    
                                                TextInput::make('twitter')
                                                    ->label(__('contacts.fields.twitter'))
                                                    ->url()
                                                    ->maxLength(255)
                                                    ->prefixIcon('heroicon-o-link')
                                                    ->placeholder(__('contacts.placeholders.twitter')),
                                            ]),
                                            
                                        Textarea::make('notes')
                                            ->label(__('contacts.fields.personal_notes'))
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->placeholder(__('contacts.placeholders.personal_notes'))
                                            ->columnSpanFull(),
                                    ])
                                    ->defaultItems(1)
                                    ->addActionLabel(__('contacts.actions.add_contact_person'))
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? __('contacts.actions.new_contact_person'))
                                    ->columnSpanFull(),
                            ]),
                            
                        Tab::make(__('contacts.tabs.documents'))
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                FileUpload::make('contactdocs')
                                    ->label(__('contacts.fields.documents'))
                                    ->directory('contactdocs')
                                    ->disk('public')
                                    ->multiple()
                                    ->acceptedFileTypes([
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
                                    ->maxFiles(10)
                                    ->maxSize(10240) // 10MB
                                    ->downloadable()
                                    ->openable()
                                    ->deletable()
                                    ->reorderable()
                                    ->uploadingMessage(__('contacts.actions.uploading_message'))
                                    ->columnSpanFull(),
                            ]),
                    ]),
                    
                Section::make(__('contacts.sections.crm_data.title'))
                    ->description(__('contacts.sections.crm_data.description'))
                    ->columnSpan(1)
                    ->schema([
                        Select::make('type')
                            ->label(__('contacts.fields.type'))
                            ->options(ContactType::options())
                            ->prefixIcon('heroicon-o-tag')
                            ->required(),
                            
                        Select::make('assigned_to')
                            ->label(__('contacts.fields.assigned_to'))
                            ->options(User::where('is_employee', true)->pluck('name', 'id'))
                            ->prefixIcon('heroicon-o-user')
                            ->searchable()
                            ->preload(),
                            
                        Select::make('source')
                            ->label(__('contacts.fields.source'))
                            ->options([
                                'website' => __('contacts.sources.website'),
                                'referral' => __('contacts.sources.referral'),
                                'linkedin' => __('contacts.sources.linkedin'),
                                'facebook' => __('contacts.sources.facebook'),
                                'google' => __('contacts.sources.google'),
                                'advertisement' => __('contacts.sources.advertisement'),
                                'email_campaign' => __('contacts.sources.email_campaign'),
                                'trade_show' => __('contacts.sources.trade_show'),
                                'networking' => __('contacts.sources.networking'),
                                'cold_call' => __('contacts.sources.cold_call'),
                                'existing_customer' => __('contacts.sources.existing_customer'),
                                'partner' => __('contacts.sources.partner'),
                                'media' => __('contacts.sources.media'),
                                'other' => __('contacts.sources.other'),
                            ])
                            ->prefixIcon('heroicon-o-arrow-top-right-on-square')
                            ->placeholder(__('contacts.placeholders.source')),
                            
                        TextInput::make('value')
                            ->label(__('contacts.fields.value'))
                            ->numeric()
                            ->prefix('kr')
                            ->prefixIcon('heroicon-o-banknotes')
                            ->placeholder(__('contacts.placeholders.value')),
                            
                        Select::make('status')
                            ->label(__('contacts.fields.status'))
                            ->options([
                                'active' => __('contacts.statuses.active'),
                                'inactive' => __('contacts.statuses.inactive'), 
                                'archived' => __('contacts.statuses.archived'),
                            ])
                            ->prefixIcon('heroicon-o-signal')
                            ->default('active')
                            ->required(),
                            
                        DatePicker::make('last_contact_date')
                            ->label(__('contacts.fields.last_contact_date'))
                            ->prefixIcon('heroicon-o-calendar-days')
                            ->displayFormat('d.m.Y'),
                            
                        DatePicker::make('next_followup_date')
                            ->label(__('contacts.fields.next_followup_date'))
                            ->prefixIcon('heroicon-o-clock')
                            ->displayFormat('d.m.Y'),
                            
                        TagsInput::make('tags')
                            ->label(__('contacts.fields.tags'))
                            ->prefixIcon('heroicon-o-hashtag')
                            ->placeholder(__('contacts.placeholders.tags'))
                            ->suggestions(__('contacts.tag_suggestions')),
                    ]),
            ]);
    }
}
