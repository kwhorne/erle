<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Messages\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class MessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Send melding')
                    ->description('Opprett en ny melding til en kollega')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->columnSpanFull()
                    ->schema([
                        Hidden::make('sender_id')
                            ->default(fn () => auth()->id()),
                            
                        Grid::make()
                            ->columns([
                                'sm' => 1,
                                'md' => 2,
                                'lg' => 3,
                            ])
                            ->schema([
                                Select::make('recipient_id')
                                    ->label('Mottaker')
                                    ->placeholder('Velg mottaker')
                                    ->options(
                                        User::where('is_employee', true)
                                            ->where('id', '!=', auth()->id())
                                            ->orderBy('name')
                                            ->pluck('name', 'id')
                                    )
                                    ->searchable()
                                    ->required()
                                    ->default(request()->get('recipient'))
                                    ->columnSpan([
                                        'sm' => 1,
                                        'md' => 1,
                                        'lg' => 2,
                                    ])
                                    ->prefixIcon('heroicon-o-user')
                                    ->helperText('Start å skriv for å søke etter navn'),
                                    
                                Select::make('priority')
                                    ->label('Prioritet')
                                    ->options([
                                        'low' => '🟢 Lav',
                                        'normal' => '🔵 Normal',
                                        'high' => '🟡 Høy',
                                        'urgent' => '🔴 Haster!',
                                    ])
                                    ->default('normal')
                                    ->required()
                                    ->columnSpan(1)
                                    ->prefixIcon('heroicon-o-exclamation-triangle'),
                            ]),
                            
                        TextInput::make('subject')
                            ->label('Emne')
                            ->required()
                            ->maxLength(255)
                            ->default(request()->get('subject'))
                            ->placeholder('F.eks. Møte i morgen, Spørsmål om prosjekt...')
                            ->prefixIcon('heroicon-o-chat-bubble-bottom-center-text')
                            ->columnSpanFull(),
                            
                        Textarea::make('body')
                            ->label('Melding')
                            ->required()
                            ->rows(6)
                            ->placeholder('Skriv din melding her...\n\nTips: Vær konkret og tydelig i kommunikasjonen.')
                            ->columnSpanFull()
                            ->helperText('Markdown støttes: **fet tekst**, *kursiv*, `kode`'),
                    ])
                    ->columns(1)
                    ->collapsible(false),
            ]);
    }
}
