<?php

namespace App\MoonShine\Resources;

use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\LineBreak;
use MoonShine\Enums\ToastType;
use MoonShine\Fields\Markdown;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Http\Responses\MoonShineJsonResponse;
use MoonShine\MoonShineRequest;

trait SeoIndexPageTrait
{
    public function seoIndexPageComponents(): array
    {
        return [
            LineBreak::make(),
            Block::make('Настройки сео для раздела', [
                \MoonShine\Components\FormBuilder::make()
                    ->name('seo-index-form')
                    ->asyncMethod(
                        'saveSeoIndexPage',
                    )
                    ->fields([
                        Grid::make([
                            Column::make([
                                Text::make('Заголовок H1', 'title')
                                    ->hint('Заголовок страницы')->required(),
                                Textarea::make('Мини описание под H1', 'description')
                                    ->hint('Минимальное описание страницы')->required(),
                                Text::make('Сео заголовок', 'seo.title')
                                    ->hint('Должен быть уникальным. Используется в мета тегах')->required(),
                                Textarea::make('Сео описание', 'seo.text')
                                    ->hint('Используется в мета тегах')->required(),
                            ])->columnSpan(6),

                            Column::make([
                                Markdown::make('Описание под списком проектов', 'content')->hint('Опционально'),
                            ])->columnSpan(6)
                        ])
                    ])->fill($this->getGroupSetting()->all()->toArray())
                    ->submit('Сохранить', ['class' => 'btn-primary btn-lg'])
            ])
        ];
    }

    public function saveSeoIndexPage(MoonShineRequest $request)
    {
        $requestData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'seo.title' => 'required|string',
            'seo.text' => 'required|string',
            'content' => 'nullable|string',
        ]);

        $this->getGroupSetting()->set($requestData);

        return MoonShineJsonResponse::make()
            ->toast('Данные успешно сохранены!', ToastType::SUCCESS);
    }
}
