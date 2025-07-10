<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Posts\Pages;

use App\Filament\App\Resources\Posts\PostResource;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;
    
    protected string $view = 'filament.app.resources.posts.pages.view-post';
    
    protected function getHeaderActions(): array
    {
        return [
            Action::make('like')
                ->label('Like innlegg')
                ->icon('heroicon-o-heart')
                ->color('danger')
                ->action(function () {
                    $this->getRecord()->incrementLikeCount();
                    $this->refreshFormData(['like_count']);
                })
                ->requiresConfirmation()
                ->modalHeading('Like innlegg')
                ->modalDescription('Er du sikker på at du vil like dette innlegget?'),
                
            ActionGroup::make([
                EditAction::make()
                    ->label('Rediger')
                    ->icon('heroicon-o-pencil')
                    ->modalHeading('Rediger innlegg')
                    ->modalWidth('7xl'),
                    
                Action::make('feature')
                    ->label(fn () => $this->getRecord()->is_featured ? 'Fjern fremheving' : 'Fremhev')
                    ->icon('heroicon-o-star')
                    ->color('warning')
                    ->action(function () {
                        $this->getRecord()->update([
                            'is_featured' => !$this->getRecord()->is_featured
                        ]);
                        $this->refreshFormData(['is_featured']);
                    }),
                    
                Action::make('publish')
                    ->label(fn () => match ($this->getRecord()->status) {
                        'draft' => 'Publiser',
                        'published' => 'Skjul',
                        'archived' => 'Reaktiver',
                        default => 'Endre status'
                    })
                    ->icon(fn () => match ($this->getRecord()->status) {
                        'draft' => 'heroicon-o-eye',
                        'published' => 'heroicon-o-eye-slash',
                        'archived' => 'heroicon-o-arrow-path',
                        default => 'heroicon-o-cog'
                    })
                    ->color(fn () => match ($this->getRecord()->status) {
                        'draft' => 'success',
                        'published' => 'warning',
                        'archived' => 'info',
                        default => 'secondary'
                    })
                    ->action(function () {
                        $newStatus = match ($this->getRecord()->status) {
                            'draft' => 'published',
                            'published' => 'archived',
                            'archived' => 'published',
                            default => 'draft'
                        };
                        
                        $updateData = ['status' => $newStatus];
                        
                        if ($newStatus === 'published' && !$this->getRecord()->published_at) {
                            $updateData['published_at'] = now();
                        }
                        
                        $this->getRecord()->update($updateData);
                        $this->refreshFormData(['status', 'published_at']);
                    })
                    ->requiresConfirmation(),
                    
                DeleteAction::make()
                    ->label('Slett')
                    ->icon('heroicon-o-trash')
                    ->modalHeading('Slett innlegg')
                    ->modalDescription('Er du sikker på at du vil slette dette innlegget? Denne handlingen kan ikke angres.')
                    ->modalSubmitActionLabel('Slett')
                    ->modalCancelActionLabel('Avbryt'),
            ])
                ->label('Handlinger')
                ->icon('heroicon-o-ellipsis-horizontal')
                ->size('sm')
                ->color('gray')
                ->button(),
        ];
    }
    
    public function mount(int|string $record): void
    {
        parent::mount($record);
        
        // Increment view count when viewing
        $this->getRecord()->incrementViewCount();
    }
    

}
