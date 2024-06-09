<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Post;
use App\Models\SettingEloquentStorage;
use MoonShine\Fields\ID;
use MoonShine\Resources\ModelResource;

#[\MoonShine\Attributes\Icon('heroicons.outline.newspaper')]
class PostResource extends ModelResource
{
    use PostFiledTrait;
    use SeoIndexPageTrait;

    protected string $model = Post::class;

    protected string $title = 'Список статей';

    protected string $postType = 'post';

    public function search(): array
    {
        return ['id', 'title', 'preview_text'];
    }

    public function detailFields(): array
    {
        return [
            ID::make()->sortable(),
        ];
    }

    public function getIndexPageComponents(): array
    {
        return $this->seoIndexPageComponents();
    }

    private function getGroupSetting(): SettingEloquentStorage
    {
        return (new SettingEloquentStorage())->group('post');
    }
}
