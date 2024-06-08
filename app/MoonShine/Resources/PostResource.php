<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\Image;
use MoonShine\Fields\Json;
use MoonShine\Fields\Markdown;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Fields\Url;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Post>
 */
class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Список статей';

    public function search(): array
    {
        return ['id', 'title', 'preview_text'];
    }

    /**
     * @return list<Field>
     */
    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Тайтл', 'title')->sortable(),
            Text::make('Превью текст', 'preview_text')->sortable(),
            Switcher::make('Опубликован', 'is_published')->sortable(),
            Image::make('Изображение', 'image'),
            Image::make('Дополнительные изображения', 'content.*.images.*')->multiple(),
            Url::make('Урл', 'slug'),
        ];
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function formFields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Block::make([
                        ID::make(),
                        Text::make('Тайтл', 'title')->required(),
                        Slug::make('Урл', 'slug')->locale('ru')->unique()->from('title')->hint('Оставьте пустым, тогда заполнится автоматически'),
                        Textarea::make('Превью текст', 'preview_text')->required(),
                        Text::make('SEO title', 'seo_title')->required()->hint('Сео текст до 255 символов'),
                        Textarea::make('SEO description', 'seo_description')->required()->hint('Сео текст до 255 символов'),
                    ]),
                ])->columnSpan(6),
                Column::make([
                    Block::make([
                        Switcher::make('Опубликован', 'is_published')->default(false),
                        Image::make('Основное изображение', 'image')
                            ->customName(fn(UploadedFile $file, Field $field) => date('Y-m-d') . '-' . Str::random(10) . '.' . $file->extension())
                            ->disk(config('moonshine.disk', 'public'))
                            ->options(config('moonshine.disk_options', []))
                            ->dir('post')
                            ->removable()
                            ->allowedExtensions(['jpg', 'png', 'jpeg']),
                    ])
                ])->columnSpan(6),
            ]),
            LineBreak::make(),
            Block::make([
                Json::make('Блок описания с изображениями', 'content')
                    ->fields([
                        Markdown::make('Текст', 'text')->required(),
                        Image::make('Карусель изображений под текстом', 'images')
                            ->customName(fn(UploadedFile $file, Field $field) => date('Y-m-d') . '-' . Str::random(10) . '.' . $file->extension())
                            ->disk(config('moonshine.disk', 'public'))
                            ->options(config('moonshine.disk_options', []))
                            ->dir('post')
                            ->removable()
                            ->allowedExtensions(['jpg', 'png', 'jpeg'])
                            ->multiple(true),
                        Switcher::make('Active')
                    ])->removable()->required()->hint('Можно разбить на несколько блоков, разделив текст - каруселью изображений'),
            ])
        ];
    }

    /**
     * @return list<Field>
     */
    public function detailFields(): array
    {
        return [
            ID::make()->sortable(),
        ];
    }

    /**
     * @param Post $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'title' => ['required', 'string'],
            'preview_text' => ['required', 'string'],
            'slug' => [Rule::unique('posts')->ignore($item->id)],
            'content' => ['required', 'array'],
            'content.*.text' => ['required', 'string'],
        ];
    }
}
