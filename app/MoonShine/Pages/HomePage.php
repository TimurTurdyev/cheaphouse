<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\SettingEloquentStorage;
use Illuminate\Http\UploadedFile;
use Illuminate\View\ComponentAttributeBag;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\FormBuilder;
use MoonShine\Components\Icon;
use MoonShine\Components\TableBuilder;
use MoonShine\Components\Title;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\LineBreak;
use MoonShine\Decorations\Tab;
use MoonShine\Decorations\Tabs;
use MoonShine\Fields\Email;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Textarea;
use MoonShine\Fields\Url;
use MoonShine\Enums\JsEvent;
use MoonShine\Enums\ToastType;
use MoonShine\Fields\Field;
use MoonShine\Fields\Fields;
use MoonShine\Fields\Image;
use MoonShine\Fields\Position;
use MoonShine\Fields\Preview;
use MoonShine\Fields\StackFields;
use MoonShine\Fields\Text;
use MoonShine\Http\Responses\MoonShineJsonResponse;
use MoonShine\MoonShineRequest;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Support\AlpineJs;

#[\MoonShine\Attributes\Icon('heroicons.outline.home')]
class HomePage extends Page
{
    public string $title = 'Редактирование главной страницы';

    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => 'Главная'
        ];
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
    {
        return [
            Block::make([
                Tabs::make([
                    Tab::make('Баннер', [
                        ActionButton::make('Добавить баннер')
                            ->primary()
                            ->icon('heroicons.outline.plus')
                            ->inModal('Добавить баннер', fn() => $this->formBannerComponent())
                        ,
                        TableBuilder::make(fields: [
                            Preview::make(
                                'Сортировка',
                                formatted: static fn() => Icon::make('heroicons.outline.bars-4')
                            ),
                            Position::make(label: 'Позиция'),
                            StackFields::make('Текст')->fields([
                                Text::make('Title')->badge(),
                                Text::make('Text')->badge(),
                                Url::make('Link', 'link'),
                            ]),
                            Image::make('image'),
                        ])
                            ->customAttributes([
                                'data-handle' => '.handle',
                            ])
                            ->tdAttributes(
                                static fn(mixed $data, int $row, int $cell, ComponentAttributeBag $attr) => $attr->when(
                                    $cell === 0,
                                    static fn(ComponentAttributeBag $a) => $a->merge(['class' => 'handle', 'style' => 'cursor: move'])
                                )
                            )
                            ->name('banner-list')
                            ->items($this->bannerItems())
                            ->async()
                            ->sortable($this->asyncMethodUrl('reorder'))
                            ->reindex()
                            ->withNotFound()
                            ->buttons([
                                ActionButton::make('')
                                    ->secondary()
                                    ->icon('heroicons.outline.pencil')
                                    ->inModal('Обновить баннер', fn($todoItem) => $this->formBannerComponent($todoItem)),
                                ActionButton::make('')
                                    ->icon('heroicons.outline.trash')
                                    ->error()
                                    ->inModal('Удалить баннер?', fn($todoItem) => $this->formBannerDeleteComponent($todoItem), auto: true),
                            ]),
                    ]),
                    Tab::make('О нас', [
                        $this->aboutForm(),
                    ]),
                ]),
            ]),
        ];
    }

    private function bannerFields(array $banner = null): array
    {
        return [
            Hidden::make(column: 'id')->setValue($banner['id'] ?? '')->required(),
            Text::make('Заголовок', 'title')->setValue($banner['title'] ?? '')->required(),
            Textarea::make('Текст', 'text')->setValue($banner['text'] ?? '')->required(),
            Text::make('Ссылка', 'link')->setValue($banner['link'] ?? ''),
            Image::make('Изображение', 'image')
                ->setValue($banner['image'] ?? '')
                ->customName(static function (UploadedFile $file, Field $field) {
                    return str(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                        ->lower()
                        ->slug(language: 'ru')
                        ->append(".{$file->extension()}");
                })
                ->disk(config('moonshine.disk', 'public'))
                ->options(config('moonshine.disk_options', []))
                ->dir('home')
                ->removable()
                ->allowedExtensions(['jpg', 'png', 'jpeg']),
        ];
    }


    /**
     * @throws \Throwable
     */
    public function save(MoonShineRequest $request): MoonShineJsonResponse
    {
        $request->validate([
            'title' => ['required', 'string'],
            'image' => ['image'],
        ]);

        $bannerItems = $this->getSettings()->get('bannerItems', []);
        $fields = Fields::make($this->bannerFields());

        /** @var Image $image */
        $image = $fields
            ->onlyFields()
            ->findByClass(Image::class);

        $imageFile = $request->file('image');
        $currentImage = $request->input('hidden_image', '');

        if (!is_null($imageFile)) {
            if ($currentImage) {
                $image->deleteFile($currentImage);
            }
            $currentImage = $image->store($imageFile);
        }

        $id = $request->input('id');

        if ($id) {
            $bannerItems[$id] = [
                'id' => $id,
                'title' => $request->input('title'),
                'text' => $request->input('text'),
                'link' => $request->input('link'),
                'image' => $currentImage,
            ];
        } else {
            $bannerItems[] = [
                'id' => count($bannerItems),
                'title' => $request->input('title'),
                'text' => $request->input('text'),
                'link' => $request->input('link'),
                'image' => $currentImage,
            ];
        }

        $this->getSettings()->set('bannerItems', $bannerItems);

        return MoonShineJsonResponse::make()
            ->toast('Баннер сохранен!', ToastType::SUCCESS);
    }

    public function removeBanner(MoonShineRequest $request)
    {
        $requestData = $request->validate([
            'id' => ['required', 'integer'],
        ]);

        $banners = $this->getSettings()->get('bannerItems', []);

        $index = 0;
        foreach ($banners as $key => $banner) {
            if ((int)$banner['id'] === (int)$requestData['id']) {
                unset($banners[$key]);
                continue;
            }
            $banners[$key]['id'] = $index;
            $index++;
        }

        $this->getSettings()->set('bannerItems', array_values($banners));

        return MoonShineJsonResponse::make()
            ->toast('Баннер удален!', ToastType::SUCCESS);
    }

    public function reorder(MoonShineRequest $request): MoonShineJsonResponse
    {
        $reorderedBanners = [];

        $banners = $this->getSettings()->get('bannerItems', []);

        foreach ($request->string('data')->explode(',') as $order => $currentIndex) {
            $banner = $banners[$currentIndex];
            $banner['id'] = $order;
            $reorderedBanners[] = $banner;
        }

        $this->getSettings()->set('bannerItems', $reorderedBanners);

        return MoonShineJsonResponse::make();
    }

    private function formBannerComponent($banner = null): FormBuilder
    {
        return FormBuilder::make()
            ->name('banner-form')
            ->asyncMethod(
                'save',
                events: $this->updateListingEvents()
            )
            ->fields($this->bannerFields($banner))
            ->submit('Сохранить', ['class' => 'btn-primary btn-lg']);
    }

    private function formBannerDeleteComponent($banner): FormBuilder
    {
        return FormBuilder::make()
            ->name('banner-delete-form')
            ->asyncMethod(
                'removeBanner',
                events: $this->updateListingEvents()
            )
            ->fields([
                Hidden::make(column: 'id')->setValue($banner['id'] ?? '')->required()
            ])
            ->submit('Да', ['class' => 'btn-primary btn-lg']);
    }

    private function bannerItems(): array
    {
        $banners = $this->getSettings()->get('bannerItems', []);
        return array_map(static function ($banner, $index) {
            return [
                'id' => $index,
                'title' => $banner['title'],
                'text' => $banner['text'],
                'link' => $banner['link'],
                'image' => $banner['image'],
            ];
        }, $banners, array_keys($banners));
    }

    public function saveAbout(MoonShineRequest $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
            'image' => ['required', 'image'],
        ]);

        return MoonShineJsonResponse::make()->toast('Сохранено!', ToastType::SUCCESS);
    }

    private function about()
    {
        return $this->getSettings()->get('about', []);
    }

    private function aboutForm()
    {
        return FormBuilder::make()
            ->name('about-form')
            ->asyncMethod(
                'saveAbout',
                events: [AlpineJs::event(JsEvent::FORM_RESET, 'about-form')]
            )
            ->fields([
                Grid::make([
                    Column::make([
                        Text::make('Заголовок', 'title')->required(),
                        Textarea::make('Text', 'text')->required(),
                    ])->columnSpan(6),

                    Column::make([
                        Image::make('Изображение', 'image')
                            ->customName(static function (UploadedFile $file, Field $field) {
                                return str(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                                    ->lower()
                                    ->slug(language: 'ru')
                                    ->append(".{$file->extension()}");
                            })
                            ->disk(config('moonshine.disk', 'public'))
                            ->options(config('moonshine.disk_options', []))
                            ->dir('home')
                            ->removable()
                            ->allowedExtensions(['jpg', 'png', 'jpeg'])
                    ])->columnSpan(6)
                ])
            ])
            ->fill($this->about())
            ->submit('Сохранить', ['class' => 'btn-primary btn-lg']);
    }

    private function getSettings(): SettingEloquentStorage
    {
        return (new SettingEloquentStorage())->group('home');
    }

    private function updateListingEvents(): array
    {
        return [
            AlpineJs::event(JsEvent::TABLE_UPDATED, 'banner-list'),
            AlpineJs::event(JsEvent::FORM_RESET, 'banner-form'),
        ];
    }
}
