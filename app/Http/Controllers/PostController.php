<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'author', 'likes'])
            ->firstOrFail();
            
        // Increment view count
        $post->increment('view_count');
        
        // Get related posts
        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('post_category_id', $post->post_category_id)
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
            
        // Get more from author
        $moreFromAuthor = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('author_id', $post->author_id)
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
        
        return view('posts.single', compact('post', 'relatedPosts', 'moreFromAuthor'));
    }
    
    public function toggleLike(Post $post)
    {
        $isLiked = $post->toggleLike();
        
        return response()->json([
            'success' => true,
            'liked' => $isLiked,
            'like_count' => $post->fresh()->like_count,
            'message' => $isLiked ? __('posts.actions.liked') : __('posts.actions.unliked')
        ]);
    }
}
