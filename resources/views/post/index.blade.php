<x-layout>
    <main class="page-header">
        <div class="container"><h1>{{ $setting->get('title', 'Список статей') }}</h1></div>
    </main>

    <div class="content">
        <div class="projects">
            <div class="container">
                <div class="filter-content-2">
                    <ul class="filter js-filter">
                        <li class="active"><a href="{{ route($type.'.index') }}#" data-filter="*">Все</a></li>
                        @foreach( $tags as $tag )
                            <li><a href="{{ route($type.'.index') }}#"
                                   data-filter=".{{ Str::slug($tag->name) }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div @if( $type === 'post' ) class="container" @endif>
                <div class="grid-items js-isotope js-grid-items">
                    @foreach( $posts as $post)
                        @php
                            $tags = [];
                            foreach( $post->tags as $tag ) {
                                $tags[] = Str::slug($tag->name);
                            }
                        @endphp
                        <div class="grid-item {{ implode(' ', $tags) }} js-isotope-item js-grid-item">
                            @if( $type === 'project'  )
                                <div class="project-item item-shadow">
                                    <img alt="" class="img-responsive" src="{{ asset('storage/' . $post->image) }}">
                                    <div class="project-hover">
                                        <div class="project-hover-content">
                                            <h3 class="project-title">{{ $post->title }}</h3>
                                            <p class="project-description">{{ $post->preview_text }}...</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('project.detail', $post->slug) }}" class="link-arrow">
                                        Подробнее <i class="icon ion-ios-arrow-right"></i>
                                    </a>
                                </div>
                            @else
                                <div class="news-item">
                                    <img alt="" src="{{ asset('storage/' . $post->image) }}">
                                    <div class="news-hover">
                                        <div class="hover-border">
                                            <div></div>
                                        </div>
                                        <div class="content">
                                            <div class="time">{{ $post->created_at->format('d.m.Y') }}</div>
                                            <h3 class="news-title">{{ $post->title }}</h3>
                                            <p class="news-description">{{ $post->preview_text }}...</p>
                                        </div>
                                        <a class="read-more" href="{{ route('post.detail', $post->slug) }}">Подробнее</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout>
