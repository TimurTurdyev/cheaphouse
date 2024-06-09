<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Post;
use App\Models\Project;
use App\Models\SettingEloquentStorage;
use MoonShine\Fields\ID;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<Project>
 */
class ProjectResource extends ModelResource
{
    use PostFiledTrait;
    use SeoIndexPageTrait;

    protected string $model = Post::class;

    protected string $title = 'Список проектов';
    protected string $postType = 'project';

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
        return (new SettingEloquentStorage())->group('project');
    }
}
