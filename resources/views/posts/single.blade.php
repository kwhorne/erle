<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $post->title }} - Erle CRM & Intranett</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <style>
        .post-container {
            --text-primary: rgb(17 24 39);
            --text-secondary: rgb(55 65 81);
            --text-muted: rgb(107 114 128);
            --bg-card: rgb(255 255 255);
            --bg-sidebar: rgb(249 250 251);
            --bg-hover: rgb(248 250 252);
            --border-card: rgb(229 231 235);
            --accent-primary: rgb(59 130 246);
            --accent-secondary: rgb(16 185 129);
            --shadow-card: rgba(0, 0, 0, 0.05);
        }
        
        .dark .post-container {
            --text-primary: rgb(255 255 255);
            --text-secondary: rgb(209 213 219);
            --text-muted: rgb(156 163 175);
            --bg-card: rgba(55 65 81 / 0.8);
            --bg-sidebar: rgba(31 41 55 / 0.8);
            --bg-hover: rgba(75 85 99 / 0.5);
            --border-card: rgb(75 85 99);
            --accent-primary: rgb(99 102 241);
            --accent-secondary: rgb(34 197 94);
            --shadow-card: rgba(0, 0, 0, 0.25);
        }
        
        .article-content {
            font-size: 1.125rem;
            line-height: 1.8;
            color: var(--text-secondary);
        }
        
        .article-content h1, .article-content h2, .article-content h3 {
            color: var(--text-primary);
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        
        .article-content h1 { font-size: 2rem; }
        .article-content h2 { font-size: 1.5rem; }
        .article-content h3 { font-size: 1.25rem; }
        
        .article-content p {
            margin-bottom: 1.5rem;
        }
        
        .article-content ul, .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }
        
        .article-content li {
            margin-bottom: 0.5rem;
        }
        
        .article-content blockquote {
            border-left: 4px solid var(--accent-primary);
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: var(--text-muted);
        }
        
        .related-post {
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            border-radius: 0.75rem;
            padding: 1.25rem;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .related-post:hover {
            background: var(--bg-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px var(--shadow-card);
        }
        
        @media (max-width: 768px) {
            .post-layout {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
    
    <div class="post-container">
        <!-- Header Navigation -->
        <div style="background: var(--bg-card); border-bottom: 1px solid var(--border-card); padding: 1rem 0;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <a href="{{ url('/app/post-feed') }}" style="color: var(--accent-primary); text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;">
                        ← {{ __('posts.actions.back_to_feed') }}
                    </a>
                    <a href="{{ url('/app/dashboard') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
        
        <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
            <!-- Post Header -->
            <div style="text-align: center; margin-bottom: 3rem; padding: 2rem; background: var(--bg-card); border: 1px solid var(--border-card); border-radius: 1rem;">
                <div style="display: inline-flex; align-items: center; background: var(--accent-primary); color: white; padding: 0.5rem 1rem; border-radius: 1rem; font-size: 0.875rem; font-weight: 500; margin-bottom: 1rem;">
                    📂 {{ $post->category->name }}
                </div>
                
                <h1 style="font-size: 2.5rem; font-weight: 800; color: var(--text-primary); margin-bottom: 1rem; line-height: 1.2;">
                    {{ $post->title }}
                </h1>
                
                @if($post->excerpt)
                    <p style="font-size: 1.25rem; color: var(--text-secondary); margin-bottom: 2rem; max-width: 48rem; margin-left: auto; margin-right: auto;">
                        {{ $post->excerpt }}
                    </p>
                @endif
                
                <div style="display: flex; justify-content: center; align-items: center; gap: 2rem; font-size: 0.9rem; color: var(--text-muted); flex-wrap: wrap;">
                    <span style="display: flex; align-items: center; gap: 0.5rem;">
                        👤 {{ $post->author->name }}
                    </span>
                    <span style="display: flex; align-items: center; gap: 0.5rem;">
                        📅 {{ $post->published_at->format('d.m.Y') }}
                    </span>
                    <span style="display: flex; align-items: center; gap: 0.5rem;">
                        👀 {{ $post->view_count }} {{ __('posts.stats.views') }}
                    </span>
                    <span style="display: flex; align-items: center; gap: 0.5rem;">
                        ❤️ {{ $post->like_count }} {{ __('posts.stats.likes') }}
                    </span>
                </div>
            </div>
            
            <!-- Featured Image -->
            @if($post->featured_image)
                <div style="margin-bottom: 3rem; text-align: center;">
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="max-width: 100%; height: auto; border-radius: 1rem; box-shadow: 0 10px 25px -3px var(--shadow-card);">
                </div>
            @endif
            
            <!-- Post Layout -->
            <div class="post-layout" style="display: grid; grid-template-columns: 1fr 300px; gap: 3rem;">
                <!-- Main Content -->
                <div style="background: var(--bg-card); border: 1px solid var(--border-card); border-radius: 1rem; padding: 2.5rem;">
                    <div class="article-content">
                        {!! $post->content !!}
                    </div>
                    
                    <!-- Post Actions -->
                    <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--border-card); display: flex; justify-content: space-between; align-items: center;">
                        <div style="display: flex; gap: 1rem;">
                            <button id="likeButton" data-post-id="{{ $post->id }}" data-liked="{{ $post->isLikedBy() ? 'true' : 'false' }}" style="background: var(--accent-primary); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 500; cursor: pointer; transition: all 0.2s;">
                                <span id="likeIcon">{{ $post->isLikedBy() ? '❤️' : '👍' }}</span>
                                <span id="likeText">{{ $post->isLikedBy() ? __('posts.actions.unlike') : __('posts.actions.like') }}</span>
                                <span id="likeCount">({{ $post->like_count }})</span>
                            </button>
                            <button style="background: var(--accent-secondary); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 500; cursor: pointer; transition: all 0.2s;">
                                📤 {{ __('posts.actions.share') }}
                            </button>
                        </div>
                        
                        <a href="{{ url('/app/post-feed') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">
                            ← {{ __('posts.actions.back_to_feed') }}
                        </a>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div>
                    <!-- Author Info -->
                    <div style="background: var(--bg-sidebar); border: 1px solid var(--border-card); border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1rem;">
                            👤 {{ __('posts.single.about_author') }}
                        </h3>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 3rem; height: 3rem; background: var(--accent-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                {{ substr($post->author->name, 0, 1) }}
                            </div>
                            <div>
                                <p style="font-weight: 500; color: var(--text-primary); margin-bottom: 0.25rem;">
                                    {{ $post->author->name }}
                                </p>
                                <p style="font-size: 0.875rem; color: var(--text-muted);">
                                    {{ $post->author->job_title ?? __('posts.stats.author') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related Posts -->
                    @if($relatedPosts->isNotEmpty())
                        <div style="background: var(--bg-sidebar); border: 1px solid var(--border-card); border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1rem;">
                                🔗 {{ __('posts.single.related_posts') }}
                            </h3>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                @foreach($relatedPosts as $relatedPost)
                                    <a href="{{ route('post.show', $relatedPost->slug) }}" class="related-post">
                                        <h4 style="font-size: 0.9rem; font-weight: 500; color: var(--text-primary); margin-bottom: 0.5rem; line-height: 1.3;">
                                            {{ $relatedPost->title }}
                                        </h4>
                                        <p style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 0.5rem;">
                                            {{ $relatedPost->published_at->format('d.m.Y') }}
                                        </p>
                                        <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.75rem; color: var(--text-muted);">
                                            <span>👀 {{ $relatedPost->view_count }}</span>
                                            <span>❤️ {{ $relatedPost->like_count }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- More from Author -->
                    @if($moreFromAuthor->isNotEmpty())
                        <div style="background: var(--bg-sidebar); border: 1px solid var(--border-card); border-radius: 1rem; padding: 1.5rem;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1rem;">
                                ✍️ {{ __('posts.single.more_from_author') }}
                            </h3>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                @foreach($moreFromAuthor as $authorPost)
                                    <a href="{{ route('post.show', $authorPost->slug) }}" class="related-post">
                                        <h4 style="font-size: 0.9rem; font-weight: 500; color: var(--text-primary); margin-bottom: 0.5rem; line-height: 1.3;">
                                            {{ $authorPost->title }}
                                        </h4>
                                        <p style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 0.5rem;">
                                            {{ $authorPost->published_at->format('d.m.Y') }}
                                        </p>
                                        <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.75rem; color: var(--text-muted);">
                                            <span>👀 {{ $authorPost->view_count }}</span>
                                            <span>❤️ {{ $authorPost->like_count }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript for like functionality -->
    <script>
        document.getElementById('likeButton').addEventListener('click', function() {
            const button = this;
            const postId = button.getAttribute('data-post-id');
            const isLiked = button.getAttribute('data-liked') === 'true';
            
            // Disable button during request
            button.disabled = true;
            button.style.opacity = '0.6';
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || ''
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update button state
                    button.setAttribute('data-liked', data.liked ? 'true' : 'false');
                    
                    // Update button content
                    const likeIcon = document.getElementById('likeIcon');
                    const likeText = document.getElementById('likeText');
                    const likeCount = document.getElementById('likeCount');
                    
                    if (data.liked) {
                        likeIcon.textContent = '❤️';
                        likeText.textContent = '{{ __('posts.actions.unlike') }}';
                        button.style.background = 'var(--accent-secondary)';
                    } else {
                        likeIcon.textContent = '👍';
                        likeText.textContent = '{{ __('posts.actions.like') }}';
                        button.style.background = 'var(--accent-primary)';
                    }
                    
                    likeCount.textContent = `(${data.like_count})`;
                    
                    // Show success message briefly
                    const originalText = likeText.textContent;
                    likeText.textContent = data.message;
                    setTimeout(() => {
                        likeText.textContent = originalText;
                    }, 1000);
                } else {
                    alert('{{ __('posts.actions.error') }}');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('{{ __('posts.actions.error') }}');
            })
            .finally(() => {
                // Re-enable button
                button.disabled = false;
                button.style.opacity = '1';
            });
        });
    </script>
</body>
</html>
