<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Field;
use MoonShine\Fields\ID;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

#[\MoonShine\Attributes\Icon('heroicons.outline.tag')]
class TagResource extends ModelResource
{
    protected string $model = Tag::class;

    protected string $title = 'Список тегов';
    protected bool $createInModal = true;
    protected bool $editInModal = true;

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Название', 'name')->required(),
                Switcher::make('Статус', 'is_published')->required(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'is_published' => ['required', 'boolean'],
        ];
    }
}
