<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Posts\Schemas;

use App\Models\PostCategory;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Innholdsinfo')
                    ->description('Grunnleggende informasjon om innlegget')
                    ->icon('heroicon-o-document-text')
                    ->columnSpan(['lg' => 2])
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Tittel')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, callable $set) {
                                        if ($operation !== 'create') {
                                            return;
                                        }
                                        $set('slug', \Illuminate\Support\Str::slug($state));
                                    })
                                    ->columnSpan(2),
                                    
                                TextInput::make('slug')
                                    ->label('Slug (URL)')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->helperText('Automatisk generert fra tittelen')
                                    ->columnSpan(2),
                                    
                                Textarea::make('excerpt')
                                    ->label('Sammendrag')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->helperText('Kort beskrivelse som vises i feed og søkeresultater')
                                    ->columnSpan(2),
                            ]),
                            
                        RichEditor::make('content')
                            ->label('Innhold')
                            ->required()
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                            ->columnSpanFull(),
                    ]),
                    
                Section::make('Kategorisering og metadata')
                    ->description('Kategorier og tilleggsinformasjon')
                    ->icon('heroicon-o-tag')
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        Select::make('post_category_id')
                            ->label('Kategori')
                            ->options(PostCategory::active()->ordered()->pluck('name', 'id'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Navn')
                                    ->required(),
                                Textarea::make('description')
                                    ->label('Beskrivelse'),
                                TextInput::make('color')
                                    ->label('Farge')
                                    ->default('#3B82F6'),
                                TextInput::make('icon')
                                    ->label('Ikon')
                                    ->default('heroicon-o-tag'),
                            ])
                            ->createOptionUsing(function (array $data) {
                                return PostCategory::create($data)->id;
                            }),
                            
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Utkast',
                                'published' => 'Publisert',
                                'archived' => 'Arkivert',
                            ])
                            ->default('draft')
                            ->required()
                            ->live(),
                            
                        DateTimePicker::make('published_at')
                            ->label('Publiseringsdato')
                            ->helperText('La stå tom for å publisere umiddelbart')
                            ->visible(fn (callable $get) => $get('status') === 'published'),
                            
                        FileUpload::make('featured_image')
                            ->label('Hovedbilde')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('posts/featured')
                            ->maxSize(5120), // 5MB
                            
                        TagsInput::make('meta_tags')
                            ->label('Emneknagger')
                            ->helperText('Legg til emneknagger for bedre søk og organisering'),
                            
                        Grid::make(2)
                            ->schema([
                                Toggle::make('is_featured')
                                    ->label('Fremhevet')
                                    ->helperText('Vis i fremhevet seksjon'),
                                    
                                Toggle::make('allow_comments')
                                    ->label('Tillat kommentarer')
                                    ->default(true),
                            ]),
                            
                        Hidden::make('author_id')
                            ->default(fn () => auth()->id()),
                    ]),
            ])
            ->columns([
                'sm' => 1,
                'lg' => 3,
            ]);
    }
}
