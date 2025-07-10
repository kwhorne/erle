@vite(['resources/css/app.css', 'resources/js/app.js'])

<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium" 
                              style="background-color: {{ $record->category->color }}20; color: {{ $record->category->color }};">
                            <x-heroicon-o-tag class="w-4 h-4 mr-1.5" />
                            {{ $record->category->name }}
                        </span>
                        
                        @if($record->status === 'published')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                <x-heroicon-o-check-circle class="w-4 h-4 mr-1.5" />
                                Publisert
                            </span>
                        @elseif($record->status === 'draft')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-100">
                                <x-heroicon-o-document class="w-4 h-4 mr-1.5" />
                                Utkast
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                <x-heroicon-o-archive-box class="w-4 h-4 mr-1.5" />
                                Arkivert
                            </span>
                        @endif
                        
                        @if($record->is_featured)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                <x-heroicon-o-star class="w-4 h-4 mr-1.5" />
                                Fremhevet
                            </span>
                        @endif
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $record->title }}</h1>
                    
                    @if($record->excerpt)
                        <p class="text-lg text-gray-600 dark:text-gray-300 mb-4">{{ $record->excerpt }}</p>
                    @endif
                </div>
                
                @if($record->featured_image)
                    <div class="ml-6 flex-shrink-0">
                        <img src="{{ asset('storage/' . $record->featured_image) }}" 
                             alt="{{ $record->title }}" 
                             class="w-32 h-32 object-cover rounded-lg shadow-md">
                    </div>
                @endif
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Content Column -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        <x-heroicon-o-document-text class="w-5 h-5 inline mr-2" />
                        Innhold
                    </h2>
                    
                    <div class="prose prose-lg max-w-none dark:prose-invert">
                        {!! $record->content !!}
                    </div>
                </div>
                
                @if($record->meta_tags && count($record->meta_tags) > 0)
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                            <x-heroicon-o-tag class="w-5 h-5 inline mr-2" />
                            Emneknagger
                        </h3>
                        
                        <div class="flex flex-wrap gap-2">
                            @foreach($record->meta_tags as $tag)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Post Information -->
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        <x-heroicon-o-information-circle class="w-5 h-5 inline mr-2" />
                        Informasjon
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Forfatter</div>
                            <div class="flex items-center mt-1">
                                <x-heroicon-o-user class="w-4 h-4 mr-2 text-gray-400" />
                                <span class="text-gray-900 dark:text-white">{{ $record->author->name }}</span>
                            </div>
                        </div>
                        
                        @if($record->published_at)
                            <div>
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Publisert</div>
                                <div class="flex items-center mt-1">
                                    <x-heroicon-o-calendar class="w-4 h-4 mr-2 text-gray-400" />
                                    <span class="text-gray-900 dark:text-white">{{ $record->published_at->format('d.m.Y H:i') }}</span>
                                </div>
                            </div>
                        @endif
                        
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Lesetid</div>
                            <div class="flex items-center mt-1">
                                <x-heroicon-o-clock class="w-4 h-4 mr-2 text-gray-400" />
                                <span class="text-gray-900 dark:text-white">{{ $record->reading_time }}</span>
                            </div>
                        </div>
                        
                        <div>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Opprettet</div>
                            <div class="flex items-center mt-1">
                                <x-heroicon-o-plus class="w-4 h-4 mr-2 text-gray-400" />
                                <span class="text-gray-900 dark:text-white">{{ $record->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                        </div>
                        
                        @if($record->updated_at->ne($record->created_at))
                            <div>
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Sist oppdatert</div>
                                <div class="flex items-center mt-1">
                                    <x-heroicon-o-pencil class="w-4 h-4 mr-2 text-gray-400" />
                                    <span class="text-gray-900 dark:text-white">{{ $record->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Statistics -->
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        <x-heroicon-o-chart-bar class="w-5 h-5 inline mr-2" />
                        Statistikk
                    </h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <div class="flex items-center justify-center">
                                <x-heroicon-o-eye class="w-5 h-5 mr-2 text-blue-500" />
                                <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($record->view_count) }}</span>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Visninger</div>
                        </div>
                        
                        <div class="text-center">
                            <div class="flex items-center justify-center">
                                <x-heroicon-o-heart class="w-5 h-5 mr-2 text-red-500" />
                                <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($record->like_count) }}</span>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Likes</div>
                        </div>
                    </div>
                </div>
                
                <!-- Settings -->
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        <x-heroicon-o-cog-6-tooth class="w-5 h-5 inline mr-2" />
                        Innstillinger
                    </h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <x-heroicon-o-chat-bubble-left-right class="w-4 h-4 mr-2 text-gray-400" />
                                <span class="text-sm text-gray-700 dark:text-gray-300">Kommentarer</span>
                            </div>
                            <span class="text-sm {{ $record->allow_comments ? 'text-green-600' : 'text-gray-500' }}">
                                {{ $record->allow_comments ? 'Tillatt' : 'Deaktivert' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
