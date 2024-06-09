<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SettingEloquentStorage;
use Artesaos\SEOTools\Facades\SEOTools;
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
        $setting = (new SettingEloquentStorage())->group($type);

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

        $settingSeo = $setting->get('seo', [
            'title' => '',
            'description' => '',
        ]);

        SEOTools::setTitle($settingSeo['title']);
        SEOTools::setDescription($settingSeo['description']);
        SEOTools::opengraph()->setUrl(request()->url());

        $breadcrumbs = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'item' => [
                    '@id' => asset('/'),
                    'name' => 'Главная',
                ]
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'item' => [
                    '@id' => route($type . '.index'),
                    'name' => $setting->get('title'),
                ]
            ],
        ];

        SEOTools::jsonLdMulti()
            ->newJsonLd()
            ->setType('BreadcrumbList')
            ->addValue('itemListElement', $breadcrumbs);

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

        $postBody = $post->preview_text;
        $images = [asset('storage/' . $post->image)];

        foreach ($post->reachContent() as $block) {
            if ($block['images']) {
                foreach ($block['images'] as $image) {
                    $images[] = asset('storage/' . $image);
                }
            }

            if ($block['text']) {
                $postBody .= ' ' . $block['text'];
            }
        }

        SEOTools::setTitle($post->seo_title);
        SEOTools::setDescription($post->seo_description);
        SEOTools::opengraph()->setUrl(request()->url());
        SEOTools::jsonLdMulti()->setType('Article');
        SEOTools::jsonLdMulti()->addValue('articleBody', $postBody);
        SEOTools::jsonLdMulti()->addValue('datePublished', $post->created_at->toDateString());
        SEOTools::jsonLdMulti()->addValue('dateCreated', $post->created_at->toDateString());
        SEOTools::jsonLdMulti()->addValue('dateModified', $post->updated_at->toDateString());
        SEOTools::jsonLdMulti()->addValue('wordcount', mb_strlen(strip_tags($postBody, 'UTF-8')));

        if ($images) {
            SEOTools::addImages($images);
        }

        $setting = (new SettingEloquentStorage())->group($type);
        $breadcrumbs = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'item' => [
                    '@id' => asset('/'),
                    'name' => 'Главная',
                ]
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'item' => [
                    '@id' => route($type . '.index'),
                    'name' => $setting->get('title', ''),
                ]
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'item' => [
                    '@id' => route($type . '.detail', $post->slug),
                    'name' => $post->title,
                ]
            ],
        ];

        SEOTools::jsonLdMulti()
            ->newJsonLd()
            ->setType('BreadcrumbList')
            ->addValue('itemListElement', $breadcrumbs);

        return view('post.detail', [
            'post' => $post,
            'posts' => $posts,
        ]);
    }
}
