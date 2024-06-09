<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Setting;
use App\Models\SettingEloquentStorage;
use Laravel\Prompts\FormBuilder;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Attributes\Icon;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\LineBreak;
use MoonShine\Enums\ToastType;
use MoonShine\Fields\Email;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Http\Responses\MoonShineJsonResponse;
use MoonShine\MoonShineRequest;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;

#[Icon('heroicons.outline.adjustments-vertical')]
class GlobalSettingPage extends Page
{
    public string $title = 'Редактирование глобальных настроек';

    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => 'Глобальные настройки'
        ];
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        return [
            Block::make([
                \MoonShine\Components\FormBuilder::make()
                    ->name('global-setting-form')
                    ->asyncMethod(
                        'save',
                    )
                    ->fields([
                        Grid::make([
                            Column::make([
                                Phone::make('Телефон', 'phone')->required(),
                                Email::make('Email', 'email')->required(),
                                Textarea::make('Адрес', 'address')->required(),
                            ])->columnSpan(6),

                            Column::make([
                                Text::make('Название возле логотипа', 'logoTitle')->required(),
                                Text::make('Название возле логотипа ниже', 'logoSubTitle'),
                            ])->columnSpan(6)
                        ])
                    ])->fill($this->globalSetting()->all()->toArray())
                    ->submit('Сохранить', ['class' => 'btn-primary btn-lg'])
            ])
        ];
    }

    public function save(MoonShineRequest $request)
    {
        $requestData = $request->validate([
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
            'logoTitle' => ['required', 'string'],
            'logoSubTitle' => ['required', 'string'],
        ]);

        $this->globalSetting()->set($requestData);

        return MoonShineJsonResponse::make()
            ->toast('Данные успешно сохранены!', ToastType::SUCCESS);
    }

    private function globalSetting(): SettingEloquentStorage
    {
        return (new SettingEloquentStorage())->group('global');
    }
}
