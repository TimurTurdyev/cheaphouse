<x-layout>

    @if( $post->type === 'project' )
        <div class="content">
            <div class="project-detail">
                <div class="slider-prev icon-chevron-left hidden-xs"></div>
                <div class="slider-next icon-chevron-right hidden-xs"></div>

                <div class="rev_slider_wrapper">
                    <div id="rev_slider2" class="rev_slider tp-overflow-hidden fullscreenbanner">
                        <ul>
                            <li data-transition="slideleft" data-masterspeed="1200" data-fsmasterspeed="1200">
                                <!-- Main image-->
                                <img src="{{ asset('storage/'.$post->image) }}" alt="" data-bgposition="center center"
                                     data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">
                                <!-- Layer 1 -->
                                <div class="tp-caption tp-shape tp-shapewrapper "
                                     data-x="['left']" data-hoffset="['0']"
                                     data-y="['top']" data-voffset="['50','50','40','40']"
                                     data-width="528"
                                     data-minwidth="528"
                                     data-whitespace="normal"
                                     data-type="shape"
                                     data-responsive_offset="on"
                                     data-frames='[{"from":"opacity:0;z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1500,"to":"o:1;","delay":0,"ease":"Power3.easeInOut"},{"delay":"wait","speed":400,"to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                     data-textAlign="['left','left','left','left']"
                                     data-paddingtop="[0,0,0,0]"
                                     data-paddingright="[0,0,0,0]"
                                     data-paddingbottom="[0,0,0,0]"
                                     data-paddingleft="[0,0,0,0]">
                                    <div class="project-detail-info">
                                        {{--                                    <div class="project-detail-control">--}}
                                        {{--                                        <span class="hide-info">hide information</span>--}}
                                        {{--                                        <span class="show-info">show information</span>--}}
                                        {{--                                    </div>--}}
                                        <div class="project-detail-content">
                                            <h3 class="project-detail-title">{{ $post->title }}</h3>
                                            <p class="project-detail-text">{{ $post->preview_text }}</p>
                                            <ul class="project-detail-list text-dark">
                                                @if( $post->client )
                                                    <li>
                                                        <span class="left">Клиент:</span>
                                                        <span class="right">{{ $post->client }}</span>
                                                    </li>
                                                @endif
                                                <li>
                                                    <span class="left">Дата начала:</span>
                                                    <span class="right">{{ $post->date_start?->format('d.m.Y') }}</span>
                                                </li>
                                                <li>
                                                    <span class="left">Дата сдачи:</span>
                                                    <span class="right">{{ $post->date_end?->format('d.m.Y') }}</span>
                                                </li>
                                                <li>
                                                    <span class="left">Тип проекта:</span>
                                                    <span
                                                        class="right">{{ $post->tags->map(static fn($postType) => $postType->name)->join(', ') }}</span>
                                                </li>
                                            </ul>
                                            <div class="project-detail-meta">
                                                <span class="left text-dark hidden-xs pull-sm-left">Share:</span>
                                                <div class="social-list pull-sm-right">
                                                    <a href="project-detail.html" class="icon ion-social-twitter"></a>
                                                    <a href="project-detail.html" class="icon ion-social-facebook"></a>
                                                    <a href="project-detail.html"
                                                       class="icon ion-social-googleplus"></a>
                                                    <a href="project-detail.html" class="icon ion-social-linkedin"></a>
                                                    <a href="project-detail.html"
                                                       class="icon ion-social-dribbble-outline"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="post-thumbnail masked" style="--bg-image: url({{ asset('storage/' . $post->image) }});">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-6 col-md-offset-1 col-lg-offset-2">
                        <div class="title-info">architecture & interior</div>
                        <h1 class="display-1">Small House Near Wroclaw</h1>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="page-content">
        <div class="primary">
            <div class="container">
                <article class="post">
                    @if( $post->type === 'post' )
                        <div class="row">
                            <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                                <div class="posted-on">
                                    <a class="url fn n" href="{{ route('post.detail', $post->slug) }}">Admin</a>
                                    on {{ $post->created_at->format('d.m.Y') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="entry-content">
                        @foreach( $post->reachContent() as $content )
                            <div class="row">
                                <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                                    {!! $content['text'] !!}
                                </div>
                            </div>

                            @if( $content['images'] )
                                <div class="post-gallery">
                                    <div class="slider-prev icon-chevron-left hidden-xs"></div>
                                    <div class="slider-next icon-chevron-right hidden-xs"></div>
                                    <div class="rev_slider_wrapper">
                                        <div id="rev_slider3" class="rev_slider tp-overflow-hidden fullscreenbanner">
                                            <ul>
                                                @foreach( $content['images'] as $image )
                                                    <li data-transition="slotzoom-horizontal" data-slotamount="7"
                                                        data-masterspeed="1000" data-fsmasterspeed="1000">
                                                        <!-- Main image-->
                                                        <img src="{{ asset('storage/' . $image) }}" alt=""
                                                             data-bgposition="center center" data-bgfit="cover"
                                                             data-bgrepeat="no-repeat" class="rev-slidebg">
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="entry-footer">
                        <div class="row">
                            <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                                <div class="post-share">
                                    <span>Share:</span>
                                    <a href="{{ route($post->type . '.detail', $post->slug) }}" class="icon ion-social-facebook"></a>
                                    <a href="{{ route($post->type . '.detail', $post->slug) }}" class="icon ion-social-twitter"></a>
                                    <a href="{{ route($post->type . '.detail', $post->slug) }}" class="icon ion-social-pinterest"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                @if( $posts->count() )
                    <section class="related-posts">
                        <div class="row">
                            <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                                <h6 class="related-post-title">{{ $post->type === 'post' ? 'Похожие посты' : 'Похожие проекты' }}</h6>
                            </div>
                        </div>
                        <x-post-carousel :items="$posts" route="project.detail"></x-post-carousel>
                    </section>
                @endif
            </div>
        </div>
    </div>
</x-layout>
