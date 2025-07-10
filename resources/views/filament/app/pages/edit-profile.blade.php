<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Profil form --}}
        <x-filament::section>
            <x-slot name="heading">
                {{ $this->heading }}
            </x-slot>
            
            <x-slot name="description">
                {{ $this->subheading }}
            </x-slot>
            
            <form wire:submit="updateProfile">
                {{ $this->editProfileForm }}
                
                <div class="mt-6 flex justify-end">
                    @foreach ($this->getUpdateProfileFormActions() as $action)
                        {{ $action }}
                    @endforeach
                </div>
            </form>
        </x-filament::section>

        {{-- Passord form --}}
        <x-filament::section>
            <form wire:submit="updatePassword">
                {{ $this->editPasswordForm }}
                
                <div class="mt-6 flex justify-end">
                    @foreach ($this->getUpdatePasswordFormActions() as $action)
                        {{ $action }}
                    @endforeach
                </div>
            </form>
        </x-filament::section>
    </div>
</x-filament-panels::page>
