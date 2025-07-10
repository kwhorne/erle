<x-filament-widgets::widget>
    <x-filament::section>
        <style>
            .welcome-container {
                --text-primary: rgb(17 24 39);
                --text-secondary: rgb(55 65 81);
                --text-muted: rgb(107 114 128);
                --bg-blue: rgb(239 246 255);
                --bg-green: rgb(240 253 244);
                --bg-purple: rgb(250 245 255);
                --bg-orange: rgb(255 247 237);
                --bg-footer: rgb(249 250 251);
                --border-blue: rgb(219 234 254);
                --border-green: rgb(187 247 208);
                --border-purple: rgb(221 214 254);
                --border-orange: rgb(254 215 170);
                --border-footer: rgb(229 231 235);
                --text-blue: rgb(30 64 175);
                --text-green: rgb(22 101 52);
                --text-purple: rgb(107 33 168);
                --text-orange: rgb(194 65 12);
                --title-blue: rgb(30 58 138);
                --title-green: rgb(20 83 45);
                --title-purple: rgb(88 28 135);
                --title-orange: rgb(154 52 18);
            }
            
            .dark .welcome-container {
                --text-primary: rgb(255 255 255);
                --text-secondary: rgb(209 213 219);
                --text-muted: rgb(156 163 175);
                --bg-blue: rgba(30 58 138 / 0.2);
                --bg-green: rgba(20 83 45 / 0.2);
                --bg-purple: rgba(88 28 135 / 0.2);
                --bg-orange: rgba(154 52 18 / 0.2);
                --bg-footer: rgba(75 85 99 / 0.5);
                --border-blue: rgba(30 58 138 / 0.3);
                --border-green: rgba(20 83 45 / 0.3);
                --border-purple: rgba(88 28 135 / 0.3);
                --border-orange: rgba(154 52 18 / 0.3);
                --border-footer: rgb(75 85 99);
                --text-blue: rgb(147 197 253);
                --text-green: rgb(134 239 172);
                --text-purple: rgb(196 181 253);
                --text-orange: rgb(251 191 36);
                --title-blue: rgb(191 219 254);
                --title-green: rgb(187 247 208);
                --title-purple: rgb(221 214 254);
                --title-orange: rgb(254 215 170);
            }
            
            @media (max-width: 768px) {
                .welcome-grid {
                    grid-template-columns: 1fr !important;
                }
            }
        </style>
        <div class="fi-section-content-ctn welcome-container">
            <!-- Welcome Header -->
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <h1 style="font-size: 1.875rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1rem;">
                    {{ __('dashboard.welcome.greeting', ['firstName' => $this->getData()['firstName']]) }}
                </h1>
            </div>
            
            <!-- Introduction Text -->
            <div style="text-align: center; max-width: 56rem; margin: 0 auto; margin-bottom: 2rem;">
                <p style="font-size: 1.125rem; color: var(--text-secondary); line-height: 1.75; margin-bottom: 1rem;">
                    {{ __('dashboard.welcome.intro') }}
                </p>
                
                <p style="font-size: 1.125rem; color: var(--text-secondary); line-height: 1.75;">
                    {{ __('dashboard.welcome.coffee') }}
                </p>
            </div>
            
            <!-- Feature Grid -->
            <div class="welcome-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-top: 2rem;">
                <div style="background-color: var(--bg-blue); border-radius: 0.75rem; padding: 1.25rem; border: 1px solid var(--border-blue);">
                    <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                        <span style="font-size: 1.5rem;">📊</span>
                        <div style="flex: 1;">
                            <h3 style="font-weight: 600; color: var(--title-blue); font-size: 1.125rem; margin-bottom: 0.5rem;">
                                {{ __('dashboard.welcome.sections.dashboard.title') }}
                            </h3>
                            <p style="color: var(--text-blue); font-size: 0.875rem; line-height: 1.5;">
                                {{ __('dashboard.welcome.sections.dashboard.description') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div style="background-color: var(--bg-green); border-radius: 0.75rem; padding: 1.25rem; border: 1px solid var(--border-green);">
                    <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                        <span style="font-size: 1.5rem;">🏢</span>
                        <div style="flex: 1;">
                            <h3 style="font-weight: 600; color: var(--title-green); font-size: 1.125rem; margin-bottom: 0.5rem;">
                                {{ __('dashboard.welcome.sections.projects.title') }}
                            </h3>
                            <p style="color: var(--text-green); font-size: 0.875rem; line-height: 1.5;">
                                {{ __('dashboard.welcome.sections.projects.description') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div style="background-color: var(--bg-purple); border-radius: 0.75rem; padding: 1.25rem; border: 1px solid var(--border-purple);">
                    <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                        <span style="font-size: 1.5rem;">📚</span>
                        <div style="flex: 1;">
                            <h3 style="font-weight: 600; color: var(--title-purple); font-size: 1.125rem; margin-bottom: 0.5rem;">
                                {{ __('dashboard.welcome.sections.knowledge.title') }}
                            </h3>
                            <p style="color: var(--text-purple); font-size: 0.875rem; line-height: 1.5;">
                                {{ __('dashboard.welcome.sections.knowledge.description') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div style="background-color: var(--bg-orange); border-radius: 0.75rem; padding: 1.25rem; border: 1px solid var(--border-orange);">
                    <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                        <span style="font-size: 1.5rem;">📰</span>
                        <div style="flex: 1;">
                            <h3 style="font-weight: 600; color: var(--title-orange); font-size: 1.125rem; margin-bottom: 0.5rem;">
                                {{ __('dashboard.welcome.sections.news.title') }}
                            </h3>
                            <p style="color: var(--text-orange); font-size: 0.875rem; line-height: 1.5;">
                                {{ __('dashboard.welcome.sections.news.description') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer Message -->
            <div style="margin-top: 2rem; padding: 1.25rem; background-color: var(--bg-footer); border-radius: 0.75rem; border: 1px solid var(--border-footer);">
                <p style="font-size: 0.875rem; color: var(--text-muted); line-height: 1.5; text-align: center;">
                    {{ __('dashboard.welcome.footer') }}
                </p>
            </div>
            
            <!-- Closing -->
            <div style="text-align: center; margin-top: 1.5rem;">
                <p style="font-size: 1.125rem; font-weight: 500; color: var(--text-primary);">
                    {{ __('dashboard.welcome.closing') }}
                </p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
