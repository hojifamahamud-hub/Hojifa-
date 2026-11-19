<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = (string) $request->string('q');

        $posts = Post::query()
            ->active()
            ->when($search, function ($q) use ($search) {
                $q->where(fn ($w) => $w->where('title_bn', 'like', "%{$search}%")
                    ->orWhere('title_en', 'like', "%{$search}%")
                    ->orWhere('content_bn', 'like', "%{$search}%")
                    ->orWhere('content_en', 'like', "%{$search}%"));
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('blog.index', ['posts' => $posts, 'search' => $search]);
    }

    public function show(Post $post)
    {
        abort_unless($post->active, 404);
        $post->increment('views');

        $related = Post::active()
            ->where('id', '!=', $post->id)
            ->latest('published_at')->limit(3)->get();

        return view('blog.show', ['post' => $post, 'related' => $related]);
    }
}
