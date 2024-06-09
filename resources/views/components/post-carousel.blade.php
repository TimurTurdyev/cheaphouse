@props([
    'items',
    'route'
])
<div class="news-carousel owl-carousel">
    @foreach( $items as $item )
        <div class="news-item">
            <img alt="" src="{{ asset('storage/'.$item->image) }}">
            <div class="news-hover">
                <div class="hover-border">
                    <div></div>
                </div>
                <div class="content">
                    <div class="time">{{ $item->created_at->format('d.m.Y') }}</div>
                    <h3 class="news-title">{{ $item->title }}</h3>
                    <p class="news-description">{{ $item->preview_text }}...</p>
                </div>
                <a class="read-more" href="{{ route($route, $item->slug) }}">Подробнее</a>
            </div>
        </div>
    @endforeach
</div>
