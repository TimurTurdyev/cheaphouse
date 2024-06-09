<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Post;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\DonutChartMetric;
use MoonShine\Metrics\LineChartMetric;
use MoonShine\Metrics\ValueMetric;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;

class Dashboard extends Page
{
    public string $title = 'Добро пожаловать';
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
		return [
            Grid::make([
                Column::make([
                    ValueMetric::make('Проектов')
                        ->value(Post::query()->where('type', 'project')->count()),
                ])->columnSpan(6),

                Column::make([
                    ValueMetric::make('Статей')
                        ->value(Post::query()->where('type', 'post')->count()),
                ])->columnSpan(6),

                Column::make([
                    DonutChartMetric::make('Метрика 1')
                        ->columnSpan(6)
                        ->values(['Тест 1' => 10000, 'Тест 2' => 9999]),
                ])->columnSpan(6),

                Column::make([
                    LineChartMetric::make('Метрика 2')
                        ->line([
                            'Выручка 1' => [
                                now()->format('Y-m-d') => 100,
                                now()->addDay()->format('Y-m-d') => 200
                            ]
                        ])
                        ->line([
                            'Выручка 2' => [
                                now()->format('Y-m-d') => 300,
                                now()->addDay()->format('Y-m-d') => 400
                            ]
                        ], '#EC4176'),
                ])->columnSpan(6)
            ]),
        ];
	}
}
