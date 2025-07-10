<?php

namespace App\Filament\App\Pages;

use App\Models\Post;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use BackedEnum;

class SinglePost extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    
    protected string $view = 'filament.app.pages.single-post';
    
    protected static bool $shouldRegisterNavigation = false;
    
    public ?Post $post = null;
    
    public function mount()
    {
        $slug = request()->route('slug');
        
        if ($slug) {
            $this->post = Post::where('slug', $slug)
                ->where('status', 'published')
                ->with(['category', 'author'])
                ->firstOrFail();
                
            // Increment view count
            $this->post->increment('view_count');
        }
    }
    
    public function getTitle(): string|Htmlable
    {
        return $this->post ? $this->post->title : __('posts.single.title');
    }
    
    public function getRelatedPosts()
    {
        if (!$this->post) {
            return collect();
        }
        
        return Post::where('status', 'published')
            ->where('id', '!=', $this->post->id)
            ->where('post_category_id', $this->post->post_category_id)
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
    }
    
    public function getMoreFromAuthor()
    {
        if (!$this->post) {
            return collect();
        }
        
        return Post::where('status', 'published')
            ->where('id', '!=', $this->post->id)
            ->where('author_id', $this->post->author_id)
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
    }
    

}
