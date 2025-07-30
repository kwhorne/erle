<?php

declare(strict_types=1);

namespace App\Filament\App\Pages\Auth;

use Exception;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Exceptions\Halt;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
 * @property \Filament\Schemas\Schema $editProfileForm
 * @property \Filament\Schemas\Schema $editPasswordForm
 */
final class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;
    use InteractsWithFormActions;

    protected static ?string $title = null;
    protected ?string $heading = null;
    protected ?string $subheading = null;
    protected static ?string $slug = 'profile';

    public function getTitle(): string
    {
        return __('profile.title');
    }

    public function getHeading(): string
    {
        return __('profile.heading');
    }

    public function getSubheading(): string
    {
        return __('profile.subheading');
    }

    protected string $view = 'filament.app.pages.edit-profile';

    protected static bool $shouldRegisterNavigation = false;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'My Profile';

    public static function getLabel(): string
    {
        return __('profile.title');
    }

    public static function getPluralLabel(): string
    {
        return static::getLabel();
    }

    public static function getNavigationLabel(): string
    {
        return __('profile.navigation_label');
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
                Section::make(__('profile.sections.personal_information.title'))
                    ->description(__('profile.sections.personal_information.description'))
                    ->columnSpan(2)
                    ->schema([
                        FileUpload::make('avatar')
                            ->label(__('profile.fields.avatar'))
                            ->image()
                            ->avatar()
                            ->disk('public')
                            ->directory('avatars')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->alignCenter(),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('profile.fields.name'))
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('email')
                                    ->label(__('profile.fields.email'))
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('phone')
                                    ->label(__('profile.fields.phone'))
                                    ->tel()
                                    ->maxLength(255),

                                DatePicker::make('birth_date')
                                    ->label(__('profile.fields.birth_date'))
                                    ->native(false)
                                    ->maxDate(now()->subYears(16)),
                            ]),

                        Textarea::make('bio')
                            ->label(__('profile.fields.bio'))
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('profile.sections.work_information.title'))
                    ->description(__('profile.sections.work_information.description'))
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('job_title')
                            ->label(__('profile.fields.job_title'))
                            ->maxLength(255),

                        TextInput::make('department')
                            ->label(__('profile.fields.department'))
                            ->maxLength(255),

                        TextInput::make('location')
                            ->label(__('profile.fields.location'))
                            ->maxLength(255),
                    ]),

                Section::make(__('profile.sections.address.title'))
                    ->description(__('profile.sections.address.description'))
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('address')
                            ->label(__('profile.fields.address'))
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('postal_code')
                                    ->label(__('profile.fields.postal_code'))
                                    ->maxLength(10),

                                TextInput::make('city')
                                    ->label(__('profile.fields.city'))
                                    ->maxLength(255),

                                TextInput::make('country')
                                    ->label(__('profile.fields.country'))
                                    ->default('Norge')
                                    ->maxLength(255),
                            ]),
                    ]),

                Section::make(__('profile.sections.social_media.title'))
                    ->description(__('profile.sections.social_media.description'))
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('linkedin_url')
                            ->label(__('profile.fields.linkedin_url'))
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://linkedin.com/in/...'),

                        TextInput::make('twitter_url')
                            ->label(__('profile.fields.twitter_url'))
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
                Section::make(__('profile.sections.change_password.title'))
                    ->description(__('profile.sections.change_password.description'))
                    ->schema([
                        TextInput::make('current_password')
                            ->password()
                            ->required()
                            ->currentPassword()
                            ->label(__('profile.fields.current_password')),

                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->rule(Password::default())
                            ->autocomplete('new-password')
                            ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                            ->live(debounce: 500)
                            ->same('passwordConfirmation')
                            ->label(__('profile.fields.new_password')),

                        TextInput::make('passwordConfirmation')
                            ->password()
                            ->required()
                            ->dehydrated(false)
                            ->label(__('profile.fields.confirm_password')),
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
                ->label(__('profile.actions.update_profile'))
                ->submit('editProfileForm'),
        ];
    }

    protected function getUpdatePasswordFormActions(): array
    {
        return [
            Action::make('updatePasswordAction')
                ->label(__('profile.actions.update_password'))
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
