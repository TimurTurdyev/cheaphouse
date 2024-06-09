<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SettingEloquentStorage;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function projectIndex(Request $request)
    {
        return $this->index($request, 'project');
    }

    public function projectDetail(Post $post)
    {
        return $this->detail($post, 'project');
    }

    public function postIndex(Request $request)
    {
        return $this->index($request, 'post');
    }

    public function postDetail(Post $post)
    {
        return $this->detail($post, 'post');
    }

    private function index(Request $request, string $type)
    {
        $setting = (new SettingEloquentStorage())->group('project');

        $posts = Post::query()
            ->where('type', $type)
            ->where('is_published', true)
            ->with('tags')
            ->get();

        $tags = [];

        foreach ($posts as $post) {
            foreach ($post->tags as $tag) {
                $tags[$tag->id] = $tag;
            }
        }

        return view('post.index', [
            'type' => $type,
            'setting' => $setting,
            'posts' => $posts,
            'tags' => $tags,
        ]);
    }

    private function detail(Post $post, string $type)
    {
        abort_if($post->type !== $type || $post->is_published !== true, 404);

        $posts = Post::query()
            ->whereNot('id', $post->id)
            ->whereIn('id', $post->tags->pluck('id'))
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('post.detail', [
            'post' => $post,
            'posts' => $posts,
        ]);
    }
}
