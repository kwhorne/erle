<x-filament-panels::page>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="space-y-6">
        <!-- Message Header -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <x-heroicon-o-user class="w-5 h-5 text-gray-500" />
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Fra</p>
                            <p class="font-medium text-gray-900">{{ $record->sender->name }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <x-heroicon-o-user class="w-5 h-5 text-gray-500" />
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Til</p>
                            <p class="font-medium text-gray-900">{{ $record->recipient->name }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        @php
                            $priorityConfig = match($record->priority) {
                                'low' => ['text' => 'Lav', 'color' => 'bg-gray-100 text-gray-800', 'icon' => 'heroicon-o-minus'],
                                'normal' => ['text' => 'Normal', 'color' => 'bg-blue-100 text-blue-800', 'icon' => null],
                                'high' => ['text' => 'Høy', 'color' => 'bg-yellow-100 text-yellow-800', 'icon' => 'heroicon-o-exclamation-triangle'],
                                'urgent' => ['text' => 'Haster!', 'color' => 'bg-red-100 text-red-800', 'icon' => 'heroicon-s-exclamation-triangle'],
                                default => ['text' => $record->priority, 'color' => 'bg-gray-100 text-gray-800', 'icon' => null],
                            };
                        @endphp
                        
                        <div>
                            <p class="text-sm text-gray-500 mb-2">Prioritet</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $priorityConfig['color'] }}">
                                @if($priorityConfig['icon'])
                                    @php $iconComponent = $priorityConfig['icon']; @endphp
                                    <x-dynamic-component :component="$iconComponent" class="w-3 h-3 mr-1" />
                                @endif
                                {{ $priorityConfig['text'] }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <x-heroicon-o-clock class="w-5 h-5 text-gray-500" />
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Sendt</p>
                            <p class="font-medium text-gray-900">{{ $record->created_at->format('d.m.Y H:i') }}</p>
                            <p class="text-sm text-gray-400">{{ $record->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message Content -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="space-y-6">
                <div>
                    <p class="text-sm text-gray-500 mb-2">Emne</p>
                    <h1 class="text-xl font-bold text-gray-900">{{ $record->subject }}</h1>
                </div>
                
                <hr class="border-gray-200" />
                
                <div>
                    <p class="text-sm text-gray-500 mb-3">Melding</p>
                    <div class="prose prose-gray max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($record->body)) !!}
                    </div>
                </div>
                
                @if($record->recipient_id === auth()->id() && $record->read_at)
                    <hr class="border-gray-200" />
                    
                    <div class="flex items-center space-x-2 text-gray-500">
                        <x-heroicon-o-eye class="w-4 h-4" />
                        <p class="text-sm">
                            Lest {{ $record->read_at->format('d.m.Y H:i') }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>
