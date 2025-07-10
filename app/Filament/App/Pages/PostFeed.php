<?php

namespace App\Filament\App\Pages;

use App\Models\Post;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use BackedEnum;

class PostFeed extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';
    
    protected string $view = 'filament.app.pages.post-feed';
    
    protected static ?string $navigationLabel = null;
    protected static ?string $title = null;
    
    public static function getNavigationLabel(): string
    {
        return __('posts.feed.navigation_label');
    }
    
    public function getTitle(): string|Htmlable
    {
        return __('posts.feed.title');
    }
    
    public static function getNavigationGroup(): ?string
    {
        return __('navigation.content');
    }
    
    public function getFeaturedPosts()
    {
        return Post::where('status', 'published')
            ->where('is_featured', true)
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
    }
    
    public function getLatestPosts()
    {
        return Post::where('status', 'published')
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->limit(12)
            ->get();
    }
    
    public function getPostsByCategory()
    {
        return Post::where('status', 'published')
            ->with(['category', 'author'])
            ->get()
            ->groupBy('category.name');
    }
    
    public function incrementViewCount($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->increment('view_count');
        }
    }
}
