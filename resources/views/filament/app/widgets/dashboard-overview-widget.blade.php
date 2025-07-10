<x-filament-widgets::widget>
    <x-filament::section>
        <style>
            .dashboard-overview {
                --text-primary: rgb(17 24 39);
                --text-secondary: rgb(55 65 81);
                --text-muted: rgb(107 114 128);
                --bg-card: rgb(255 255 255);
                --bg-success: rgb(240 253 244);
                --bg-warning: rgb(254 252 232);
                --bg-danger: rgb(254 242 242);
                --bg-info: rgb(239 246 255);
                --border-card: rgb(229 231 235);
                --border-success: rgb(187 247 208);
                --border-warning: rgb(253 230 138);
                --border-danger: rgb(254 202 202);
                --border-info: rgb(219 234 254);
                --text-success: rgb(22 101 52);
                --text-warning: rgb(146 64 14);
                --text-danger: rgb(153 27 27);
                --text-info: rgb(30 64 175);
            }
            
            .dark .dashboard-overview {
                --text-primary: rgb(255 255 255);
                --text-secondary: rgb(209 213 219);
                --text-muted: rgb(156 163 175);
                --bg-card: rgba(55 65 81 / 0.5);
                --bg-success: rgba(20 83 45 / 0.2);
                --bg-warning: rgba(146 64 14 / 0.2);
                --bg-danger: rgba(153 27 27 / 0.2);
                --bg-info: rgba(30 64 175 / 0.2);
                --border-card: rgb(75 85 99);
                --border-success: rgba(20 83 45 / 0.3);
                --border-warning: rgba(146 64 14 / 0.3);
                --border-danger: rgba(153 27 27 / 0.3);
                --border-info: rgba(30 64 175 / 0.3);
                --text-success: rgb(134 239 172);
                --text-warning: rgb(253 230 138);
                --text-danger: rgb(254 202 202);
                --text-info: rgb(147 197 253);
            }
            
            @media (max-width: 768px) {
                .dashboard-grid {
                    grid-template-columns: 1fr !important;
                }
            }
        </style>
        
        <div class="dashboard-overview">
            <!-- Header -->
            <div style="text-align: center; margin-bottom: 2rem;">
                <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">
                    📊 {{ __('dashboard.overview.title') }}
                </h2>
                <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.6;">
                    {{ __('dashboard.overview.description') }}
                </p>
            </div>
            
            <!-- Dashboard Grid -->
            <div class="dashboard-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                
                <!-- Today's Tasks -->
                <div style="background-color: var(--bg-card); border-radius: 0.75rem; padding: 1.5rem; border: 1px solid var(--border-card);">
                    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <span style="font-size: 1.25rem; margin-right: 0.5rem;">✅</span>
                        <h3 style="font-weight: 600; color: var(--text-primary); font-size: 1.125rem;">
                            {{ __('dashboard.overview.tasks.title') }}
                        </h3>
                    </div>
                    
                    <div style="space-y: 0.75rem;">
                        @foreach($todaysTasks as $task)
                            <div style="padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border-card); margin-bottom: 0.75rem;">
                                <div style="display: flex; justify-content: between; align-items: center;">
                                    <div style="flex: 1;">
                                        <p style="font-weight: 500; color: var(--text-primary); font-size: 0.875rem;">
                                            {{ $task['title'] }}
                                        </p>
                                        <p style="color: var(--text-muted); font-size: 0.75rem;">
                                            {{ __('dashboard.overview.tasks.deadline') }} {{ $task['deadline'] }}
                                        </p>
                                    </div>
                                    <span style="
                                        padding: 0.25rem 0.5rem; 
                                        border-radius: 0.25rem; 
                                        font-size: 0.75rem; 
                                        font-weight: 500;
                                        @if($task['priority'] === 'high') 
                                            background-color: var(--bg-danger); 
                                            color: var(--text-danger); 
                                            border: 1px solid var(--border-danger);
                                        @elseif($task['priority'] === 'medium') 
                                            background-color: var(--bg-warning); 
                                            color: var(--text-warning); 
                                            border: 1px solid var(--border-warning);
                                        @else 
                                            background-color: var(--bg-success); 
                                            color: var(--text-success); 
                                            border: 1px solid var(--border-success);
                                        @endif
                                    ">
                                        @if($task['priority'] === 'high') {{ __('dashboard.overview.tasks.priority.high') }}
                                        @elseif($task['priority'] === 'medium') {{ __('dashboard.overview.tasks.priority.medium') }}
                                        @else {{ __('dashboard.overview.tasks.priority.low') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Fresh Leads -->
                <div style="background-color: var(--bg-card); border-radius: 0.75rem; padding: 1.5rem; border: 1px solid var(--border-card);">
                    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <span style="font-size: 1.25rem; margin-right: 0.5rem;">🚀</span>
                        <h3 style="font-weight: 600; color: var(--text-primary); font-size: 1.125rem;">
                            {{ __('dashboard.overview.leads.title') }}
                        </h3>
                    </div>
                    
                    <div style="space-y: 0.75rem;">
                        @foreach($freshLeads as $lead)
                            <div style="padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border-card); margin-bottom: 0.75rem;">
                                <p style="font-weight: 500; color: var(--text-primary); font-size: 0.875rem;">
                                    {{ $lead['name'] }}
                                </p>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.25rem;">
                                    <span style="color: var(--text-success); font-weight: 600; font-size: 0.875rem;">
                                        {{ $lead['value'] }} {{ __('dashboard.overview.leads.value') }}
                                    </span>
                                    <span style="color: var(--text-muted); font-size: 0.75rem;">
                                        {{ $lead['source'] }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Latest News -->
                <div style="background-color: var(--bg-card); border-radius: 0.75rem; padding: 1.5rem; border: 1px solid var(--border-card);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                        <div style="display: flex; align-items: center;">
                            <span style="font-size: 1.25rem; margin-right: 0.5rem;">📢</span>
                            <h3 style="font-weight: 600; color: var(--text-primary); font-size: 1.125rem;">
                                {{ __('dashboard.overview.news.title') }}
                            </h3>
                        </div>
                        <a href="{{ \App\Filament\App\Pages\PostFeed::getUrl() }}" style="color: var(--accent-primary); text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                            Se alle →
                        </a>
                    </div>
                    
                    <div style="space-y: 0.75rem;">
                        @foreach($latestNews as $news)
                            <div style="padding: 0.75rem; border-radius: 0.5rem; border: 1px solid var(--border-card); margin-bottom: 0.75rem;">
                                <p style="font-weight: 500; color: var(--text-primary); font-size: 0.875rem;">
                                    {{ $news['title'] }}
                                </p>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.25rem;">
                                    <span style="color: var(--text-info); font-size: 0.75rem;">
                                        {{ $news['author'] }}
                                    </span>
                                    <span style="color: var(--text-muted); font-size: 0.75rem;">
                                        {{ $news['time'] }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
