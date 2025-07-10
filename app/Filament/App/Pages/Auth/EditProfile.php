<?php

namespace App\Filament\App\Pages\Auth;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Exception;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Hash;
use Filament\Support\Exceptions\Halt;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * @property \Filament\Schemas\Schema $editProfileForm
 * @property \Filament\Schemas\Schema $editPasswordForm
 */
class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;
    use InteractsWithFormActions;
    protected static ?string $title = 'Min Profil';
    protected ?string $heading = 'Min Profil';
    protected ?string $subheading = 'Oppdater din personlige informasjon og kontaktdetaljer.';
    protected static ?string $slug = 'profile';

    protected string $view = 'filament.app.pages.edit-profile';

    protected static bool $shouldRegisterNavigation = false;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Min Profil';
    
    public static function getLabel(): string
    {
        return 'Min Profil';
    }
    
    public static function getPluralLabel(): string
    {
        return static::getLabel();
    }
    
    public static function getNavigationLabel(): string
    {
        return 'Min Profil';
    }

    public ?array $profileData = [];
    public ?array $passwordData = [];

    public function mount(): void
    {
        $this->fillForms();
    }

    protected function getForms(): array
    {
        return [
            'editProfileForm',
            'editPasswordForm',
        ];
    }

    public function editProfileForm(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Personlig informasjon')
                    ->description('Oppdater din personlige informasjon og kontaktdetaljer.')
                    ->columnSpan(2)
                    ->schema([
                        FileUpload::make('avatar')
                            ->label('Profilbilde')
                            ->image()
                            ->avatar()
                            ->directory('avatars')
                            ->visibility('private')
                            ->maxSize(2048)
                            ->alignCenter(),
                            
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Fullt navn')
                                    ->required()
                                    ->maxLength(255),
                                    
                                TextInput::make('email')
                                    ->label('E-postadresse')
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                            ]),
                            
                        Grid::make(2)
                            ->schema([
                                TextInput::make('phone')
                                    ->label('Telefonnummer')
                                    ->tel()
                                    ->maxLength(255),
                                    
                                DatePicker::make('birth_date')
                                    ->label('Fødselsdato')
                                    ->native(false)
                                    ->maxDate(now()->subYears(16)),
                            ]),
                            
                        Textarea::make('bio')
                            ->label('Om meg')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),
                    
                Section::make('Arbeidsinformasjon')
                    ->description('Din rolle og ansettelsesdetaljer.')
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('job_title')
                            ->label('Stillingstittel')
                            ->maxLength(255),
                            
                        TextInput::make('department')
                            ->label('Avdeling')
                            ->maxLength(255),
                            
                        TextInput::make('location')
                            ->label('Arbeidssted')
                            ->maxLength(255),
                    ]),
                    
                Section::make('Adresse')
                    ->description('Din adresse og stedinformasjon.')
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('address')
                            ->label('Adresse')
                            ->maxLength(255)
                            ->columnSpanFull(),
                            
                        Grid::make(3)
                            ->schema([
                                TextInput::make('postal_code')
                                    ->label('Postnummer')
                                    ->maxLength(10),
                                    
                                TextInput::make('city')
                                    ->label('By')
                                    ->maxLength(255),
                                    
                                TextInput::make('country')
                                    ->label('Land')
                                    ->default('Norge')
                                    ->maxLength(255),
                            ]),
                    ]),
                    
                Section::make('Sosiale medier')
                    ->description('Dine profiler på sosiale medier.')
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('linkedin_url')
                            ->label('LinkedIn profil')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://linkedin.com/in/...'),
                            
                        TextInput::make('twitter_url')
                            ->label('Twitter/X profil')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://twitter.com/...'),
                    ]),
            ])
            ->model($this->getUser())
            ->statePath('profileData');
    }

    public function editPasswordForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Oppdater passord')
                    ->description('Sørg for at du bruker et godt, tilfeldig og sikkert passord.')
                    ->schema([
                        TextInput::make('current_password')
                            ->password()
                            ->required()
                            ->currentPassword()
                            ->label('Nåværende passord'),

                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->rule(Password::default())
                            ->autocomplete('new-password')
                            ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                            ->live(debounce: 500)
                            ->same('passwordConfirmation')
                            ->label('Nytt passord'),
                            
                        TextInput::make('passwordConfirmation')
                            ->password()
                            ->required()
                            ->dehydrated(false)
                            ->label('Bekreft nytt passord'),
                    ]),
            ])
            ->model($this->getUser())
            ->statePath('passwordData');
    }

    public function updateProfile(): void
    {
        try {
            $data = $this->editProfileForm->getState();

            $this->handleRecordUpdate($this->getUser(), $data);
        } catch (Halt $exception) {
            return;
        }

        $this->sendSuccessNotification();
    }

    public function updatePassword(): void
    {
        try {
            $data = $this->editPasswordForm->getState();

            $this->handleRecordUpdate($this->getUser(), $data);
        } catch (Halt $exception) {
            return;
        }

        session()->forget('password_hash_' . Filament::getCurrentOrDefaultPanel()->getAuthGuard());
        Filament::auth()->login($this->getUser());

        $this->editPasswordForm->fill();

        $this->sendSuccessNotification();
    }

    protected function getUpdateProfileFormActions(): array
    {
        return [
            Action::make('updateProfileAction')
                ->label('Lagre profil')
                ->submit('editProfileForm'),
        ];
    }

    protected function getUpdatePasswordFormActions(): array
    {
        return [
            Action::make('updatePasswordAction')
                ->label('Oppdater passord')
                ->submit('editPasswordForm'),
        ];
    }

    protected function getUser(): Authenticatable & Model
    {
        $user = Filament::auth()->user();

        if (! $user instanceof Model) {
            throw new Exception('The authenticated user object must be an Eloquent model to allow the profile page to update it.');
        }

        return $user;
    }

    protected function fillForms(): void
    {
        $data = $this->getUser()->attributesToArray();

        $this->editProfileForm->fill($data);
        $this->editPasswordForm->fill();
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        return $record;
    }

    private function sendSuccessNotification(): void
    {
        Notification::make()
            ->success()
            ->title('Profil oppdatert')
            ->body('Din profil har blitt oppdatert.')
            ->send();
    }
}
