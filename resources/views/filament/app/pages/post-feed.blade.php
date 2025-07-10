<x-filament-panels::page>
    <style>
        .post-feed-container {
            --text-primary: rgb(17 24 39);
            --text-secondary: rgb(55 65 81);
            --text-muted: rgb(107 114 128);
            --bg-card: rgb(255 255 255);
            --bg-featured: rgb(250 250 255);
            --bg-hover: rgb(248 250 252);
            --border-card: rgb(229 231 235);
            --border-featured: rgb(199 210 254);
            --accent-primary: rgb(59 130 246);
            --accent-secondary: rgb(16 185 129);
            --shadow-card: rgba(0, 0, 0, 0.05);
        }
        
        .dark .post-feed-container {
            --text-primary: rgb(255 255 255);
            --text-secondary: rgb(209 213 219);
            --text-muted: rgb(156 163 175);
            --bg-card: rgba(55 65 81 / 0.8);
            --bg-featured: rgba(67 56 202 / 0.1);
            --bg-hover: rgba(75 85 99 / 0.5);
            --border-card: rgb(75 85 99);
            --border-featured: rgba(67 56 202 / 0.3);
            --accent-primary: rgb(99 102 241);
            --accent-secondary: rgb(34 197 94);
            --shadow-card: rgba(0, 0, 0, 0.25);
        }
        
        .post-card {
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            border-radius: 1rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px var(--shadow-card);
        }
        
        .post-card:hover {
            background: var(--bg-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -3px var(--shadow-card);
        }
        
        .post-card.featured {
            background: var(--bg-featured);
            border-color: var(--border-featured);
            position: relative;
        }
        
        .post-card.featured::before {
            content: '⭐';
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.25rem;
        }
        
        .post-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 0.75rem;
            font-size: 0.875rem;
            color: var(--text-muted);
        }
        
        .post-category {
            background: var(--accent-primary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .post-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
            font-size: 0.875rem;
            color: var(--text-muted);
        }
        
        @media (max-width: 768px) {
            .post-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
    
    <div class="post-feed-container">
        <!-- Hero Section -->
        <div style="text-align: center; margin-bottom: 3rem; padding: 2rem; background: linear-gradient(135deg, var(--bg-featured) 0%, var(--bg-card) 100%); border-radius: 1rem; border: 1px solid var(--border-featured);">
            <h1 style="font-size: 2.5rem; font-weight: 800; color: var(--text-primary); margin-bottom: 1rem;">
                📰 {{ __('posts.feed.title') }}
            </h1>
            <p style="font-size: 1.125rem; color: var(--text-secondary); max-width: 42rem; margin: 0 auto;">
                {{ __('posts.feed.description') }}
            </p>
        </div>
        
        <!-- Featured Posts -->
        @if($this->getFeaturedPosts()->isNotEmpty())
            <div style="margin-bottom: 3rem;">
                <h2 style="font-size: 1.75rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    ⭐ {{ __('posts.feed.featured_posts') }}
                </h2>
                
                <div class="post-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem;">
                    @foreach($this->getFeaturedPosts() as $post)
                        <article class="post-card featured">
                            @if($post->featured_image)
                                <div style="margin-bottom: 1rem; border-radius: 0.5rem; overflow: hidden;">
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                                </div>
                            @endif
                            
                            <div>
                                <span class="post-category">{{ $post->category->name }}</span>
                                <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--text-primary); margin: 0.75rem 0; line-height: 1.4;">
                                    <a href="{{ route('post.show', $post->slug) }}" style="text-decoration: none; color: inherit; hover: color: var(--accent-primary);">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p style="color: var(--text-secondary); line-height: 1.6; margin-bottom: 1rem;">
                                    {{ $post->excerpt }}
                                </p>
                                
                                <div class="post-meta">
                                    <span>👤 {{ $post->author->name }}</span>
                                    <span>📅 {{ $post->published_at->format('d.m.Y') }}</span>
                                </div>
                                
                                <div class="post-stats">
                                    <span>👀 {{ $post->view_count }} {{ __('posts.views') }}</span>
                                    <span>❤️ {{ $post->like_count }} {{ __('posts.likes') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
        
        <!-- Latest Posts -->
        <div style="margin-bottom: 3rem;">
            <h2 style="font-size: 1.75rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                🔥 {{ __('posts.feed.latest_posts') }}
            </h2>
            
            <div class="post-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
                @foreach($this->getLatestPosts() as $post)
                    <article class="post-card">
                        @if($post->featured_image)
                            <div style="margin-bottom: 1rem; border-radius: 0.5rem; overflow: hidden;">
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="width: 100%; height: 160px; object-fit: cover;">
                            </div>
                        @endif
                        
                        <div>
                            <span class="post-category">{{ $post->category->name }}</span>
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin: 0.75rem 0; line-height: 1.4;">
                                <a href="{{ route('post.show', $post->slug) }}" style="text-decoration: none; color: inherit; hover: color: var(--accent-primary);">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p style="color: var(--text-secondary); line-height: 1.6; margin-bottom: 1rem; font-size: 0.9rem;">
                                {{ Str::limit($post->excerpt, 100) }}
                            </p>
                            
                            <div class="post-meta">
                                <span>👤 {{ $post->author->name }}</span>
                                <span>📅 {{ $post->published_at->format('d.m.Y') }}</span>
                            </div>
                            
                            <div class="post-stats">
                                <span>👀 {{ $post->view_count }}</span>
                                <span>❤️ {{ $post->like_count }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div style="text-align: center; padding: 2rem; background: var(--bg-card); border: 1px solid var(--border-card); border-radius: 1rem;">
            <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1rem;">
                {{ __('posts.feed.quick_actions') }}
            </h3>
            <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ url('/app/posts/create') }}" style="background: var(--accent-primary); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-weight: 500; transition: all 0.2s;">
                    ✍️ {{ __('posts.create_new') }}
                </a>
                <a href="{{ url('/app/post-categories') }}" style="background: var(--accent-secondary); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-weight: 500; transition: all 0.2s;">
                    📋 {{ __('posts.manage_categories') }}
                </a>
            </div>
        </div>
    </div>
</x-filament-panels::page>
