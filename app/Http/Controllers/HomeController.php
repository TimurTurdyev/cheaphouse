<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SettingEloquentStorage;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HomeController extends Controller
{
    public function index(SettingEloquentStorage $setting): string
    {
        $tags = Tag::query()
            ->with(['posts' => function (BelongsToMany $query) {
                $query->where('posts.is_published', true);
                $query->where('posts.type', 'project');

                $query->limit(3)->orderBy('created_at', 'desc');
            }, 'posts.tags'])
            ->join('post_tag', 'tags.id', '=', 'post_tag.tag_id')
            ->join('posts', 'post_tag.post_id', '=', 'posts.id')
            ->where('posts.type', 'project')
            ->where('posts.is_published', true)
            ->where('tags.is_published', true)
            ->groupBy('tags.id')
            ->get(['tags.*']);

        $projects = collect();

        foreach ($tags as $tag) {
            foreach ($tag->posts as $post) {
                if ($projects->has($post->id)) {
                    continue;
                }
                $projects[$post->id] = $post;
            }
        }

        $projects = $projects->sortByDesc('updated_at', SORT_STRING)->take(3);

        $posts = Post::query()
            ->where('is_published', true)
            ->where('type', 'post')
            ->orderByDesc('created_at')
            ->take(7)
            ->get();

        return view('welcome', [
            'setting' => $setting->group('home'),
            'projectTypes' => $tags,
            'projects' => $projects,
            'posts' => $posts,
        ]);
    }
}
