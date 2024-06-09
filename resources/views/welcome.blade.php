<x-layout>
    <!-- Jumbotron -->
    <main class="jumbotron">

        <!-- Start revolution slider -->

        <div class="rev_slider_wrapper">
            <div id="rev_slider" class="rev_slider tp-overflow-hidden fullscreenbanner">
                <ul>
                    @if( $bannerItems = $setting->get('bannerItems', []) )
                        @foreach( $bannerItems as $bannerItem )
                            <li data-transition='slideleft' data-slotamount='default' data-masterspeed="1000"
                                data-fsmasterspeed="1000">
                                <!-- Main image-->
                                <img src="{{ asset('storage/'.$bannerItem['image']) }}" data-bgparallax="5" alt=""
                                     data-bgposition="center 0"
                                     data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">
                                <!-- Layer 1 -->
                                <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"
                                     data-x="['left']" data-hoffset="['100']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['-250']"
                                     data-width="270"
                                     data-height="5"
                                     data-whitespace="nowrap"
                                     data-type="shape"
                                     data-responsive_offset="on"
                                     data-frames='[{"from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1000,"to":"o:1;","delay":0,"ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                     data-textAlign="['left','left','left','left']"
                                     data-paddingtop="[0,0,0,0]"
                                     data-paddingright="[0,0,0,0]"
                                     data-paddingbottom="[0,0,0,0]"
                                     data-paddingleft="[0,0,0,0]"
                                     style="background-color:#cee002;"></div>
                                <!-- Layer 2 -->
                                <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"
                                     data-x="['left']" data-hoffset="['370']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['19']"
                                     data-width="5"
                                     data-height="544"
                                     data-whitespace="nowrap"
                                     data-type="shape"
                                     data-responsive_offset="on"
                                     data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1000,"to":"o:1;","delay":600,"ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                     data-textAlign="['left','left','left','left']"
                                     data-paddingtop="[0,0,0,0]"
                                     data-paddingright="[0,0,0,0]"
                                     data-paddingbottom="[0,0,0,0]"
                                     data-paddingleft="[0,0,0,0]"
                                     style="background-color:#cee002;"></div>
                                <!-- Layer 3 -->
                                <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"
                                     data-x="['left']" data-hoffset="['100']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['289']"
                                     data-width="270"
                                     data-height="5"
                                     data-whitespace="nowrap"
                                     data-type="shape"
                                     data-responsive_offset="on"
                                     data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1000,"to":"o:1;","delay":1200,"ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                     data-textAlign="['left','left','left','left']"
                                     data-paddingtop="[0,0,0,0]"
                                     data-paddingright="[0,0,0,0]"
                                     data-paddingbottom="[0,0,0,0]"
                                     data-paddingleft="[0,0,0,0]"
                                     style="background-color:#cee002;"></div>
                                <!-- Layer 4 -->
                                <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"
                                     data-x="['left']" data-hoffset="['100']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['19']"
                                     data-width="5"
                                     data-height="544"
                                     data-whitespace="nowrap"
                                     data-type="shape"
                                     data-responsive_offset="on"
                                     data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1000,"to":"o:1;","delay":1800,"ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                     data-textAlign="['left','left','left','left']"
                                     data-paddingtop="[0,0,0,0]"
                                     data-paddingright="[0,0,0,0]"
                                     data-paddingbottom="[0,0,0,0]"
                                     data-paddingleft="[0,0,0,0]"
                                     style="background-color:#cee002;"></div>
                                <!-- Layer 5 -->
                                <div class="slider-title tp-caption tp-resizeme"
                                     data-x="['left']" data-hoffset="['156']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['-30']"
                                     data-textAlign="['left']"
                                     data-fontsize="['72', '63','57','50']"
                                     data-lineheight="['72','68', '62','54']"
                                     data-height="none"
                                     data-whitespace="nowrap"
                                     data-transform_idle="o:1;"
                                     data-transform_in="x:[-155%];z:0;rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power2.easeInOut;"
                                     data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                     data-mask_in="x:50px;y:0px;s:inherit;e:inherit;"
                                     data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                     data-start="500"
                                     data-splitin="chars"
                                     data-splitout="none"
                                     data-responsive_offset="on"
                                     data-elementdelay="0.05" style="font-weight:600; letter-spacing:-0.05em;">
                                    {!! nl2br(trim((string)$bannerItem['text'])) !!}
                                </div>
                                <!-- Layer 6 -->
                                <div class="slider-title tp-caption"
                                     data-x="['left']" data-hoffset="['156']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['-170']"
                                     data-textAlign="['left']"
                                     data-fontsize="['18']"
                                     data-lineheight="['20']"
                                     data-height="none"
                                     data-whitespace="nowrap"
                                     data-transform_idle="o:1;"
                                     data-transform_in="x:[155%];z:0;rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power2.easeInOut;"
                                     data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                     data-mask_in="x:50px;y:0px;s:inherit;e:inherit;"
                                     data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                     data-start="1000"
                                     data-splitin="chars"
                                     data-splitout="none"
                                     data-responsive_offset="on"
                                     data-elementdelay="0.05"
                                     style="font-weight:600; letter-spacing:0.1em; text-transform:uppercase;">{{ $bannerItem['title'] }}
                                </div>
                                @if( $bannerItem['link'] )
                                    <!-- Layer 7 -->
                                    <div class="slider-title tp-caption"
                                         data-x="['left']" data-hoffset="['156']"
                                         data-y="['middle','middle','middle','middle']" data-voffset="['230']"
                                         data-textAlign="['left']"
                                         data-fontsize="['18']"
                                         data-lineheight="['20']"
                                         data-height="none"
                                         data-whitespace="nowrap"
                                         data-transform_idle="o:1;"
                                         data-transform_in="x:[-105%];z:0;rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power2.easeInOut;"
                                         data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                         data-mask_in="x:50px;y:0px;s:inherit;e:inherit;"
                                         data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                         data-start="1500"
                                         data-splitin="none"
                                         data-splitout="none"
                                         data-responsive_offset="on"
                                         data-elementdelay="0.05" style="font-weight:600;">
                                        <a href="{{ $bannerItem['link'] }}" class="link-arrow">
                                            {{ $bannerItem['linkText'] ?? 'Подробнее' }}
                                            <i class="icon ion-ios-arrow-thin-right"></i>
                                        </a>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <x-home-banner/>
                    @endif
                </ul>
            </div>
        </div>
    </main>
    <div class="content">
        <!-- Section About -->
        <section class="section-about">
            <div class="container">
                <div class="row">
                    @if( $about = $setting->get('about') )
                        <div class="col-md-6">
                            <strong class="section-subtitle">О нас</strong>
                            <h2 class="section-title section-about-title">{{ $about['title'] }}</h2>
                            <p>{!! nl2br((trim((string)$about['text']))) !!}</p>
                            <div class="experience-box">
                                <div class="experience-border"></div>
                                <div class="experience-content">
                                    <div class="experience-number">{{ $about['experience'] ?? '' }}</div>
                                    <div
                                        class="experience-info wow fadeInDown">{!! nl2br(trim((string)($about['experienceText'] ?? ''))) !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <div class="dots-image">
                                <img alt="" class="about-img img-responsive"
                                     src="{{ asset('storage/'.($about['image'] ?? '')) }}">
                                <div class="dots"></div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-6">
                            <strong class="section-subtitle">about us</strong>
                            <h2 class="section-title section-about-title">We Are The Leader In The Architectural</h2>
                            <p>For each project we establish relationships with partners who we know will help us create
                                added value for your project. As well as bringing together the public and private
                                sectors, we make sector-overarching links to gather knowledge and to learn from each
                                other</p>
                            <div class="experience-box">
                                <div class="experience-border"></div>
                                <div class="experience-content">
                                    <div class="experience-number">26</div>
                                    <div class="experience-info wow fadeInDown">Years<br>Experience<br>Working</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <div class="dots-image">
                                <img alt="" class="about-img img-responsive"
                                     src="{{ asset('theme/images/1-470x660.jpg') }}">
                                <div class="dots"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Section Projects -->

        <section class="section-projects section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <h2 class="section-title">Наши проекты</h2>
                    </div>
                    <div class="col-lg-7">
                        <div class="filter-content">
                            <ul class="filter-carousel filter pull-lg-right js-filter-carousel">
                                <li class="active"><a href="{{ route('home') }}#" class="all" data-filter="*">Все</a>
                                </li>
                                @foreach( $projectTypes as $projectType )
                                    <li>
                                        <a href="{{ route('home') }}#"
                                           data-filter=".{{ Str::slug($projectType->name) }}">{{ $projectType->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('project.index') }}" class="view-projects">Смотреть все проекты</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="project-carousel owl-carousel">
                @foreach( $projects as $project )
                    @php
                        $tags = [];
                        foreach( $project->tags as $tag ) {
                            $tags[] = Str::slug($tag->name);
                        }
                    @endphp
                    <div class="project-item item-shadow {{ implode(' ', $tags) }}">
                        <img alt="" class="img-responsive" src="{{ asset('storage/' . $project->image) }}">
                        <div class="project-hover">
                            <div class="project-hover-content">
                                <h3 class="project-title">{{ $project->title }}</h3>
                                <p class="project-description">{{ $project->preview_text }}...</p>
                            </div>
                        </div>
                        <a href="{{ route('project.detail', $project->slug) }}" class="link-arrow">Подробнее <i
                                class="icon ion-ios-arrow-right"></i></a>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Section Clients -->

        <section class="section-clients section bg-dots">
            <div class="container">
                <h2 class="section-title">From Great Our Clients</h2>
                <div class="client-carousel owl-carousel">
                    <div class="client-carousel-item">
                        <img alt="" class="client-img" src="{{ asset('theme/images/clients/1-92x92.jpg') }}">
                        <div class="client-box">
                            <img alt="" class="image-quote"
                                 src="{{ asset('theme/images/image-icons/icon-quote.png') }}">
                            <div class="client-title">
                                <span class="client-name">Adam Stone</span>
                                <span class="client-company">/ CEO at Google INC</span>
                            </div>
                            <p class="client-description">Sed elit quam, iaculis sed semper sit amet udin vitae
                                nibh. at magna akal semperFusce commodo molestie luctus.Lorem ipsum Dolor tusima
                                olatiup.</p>
                        </div>
                    </div>
                    <div class="client-carousel-item">
                        <img alt="" class="client-img" src="{{ asset('theme/images/clients/2-92x92.jpg') }}">
                        <div class="client-box">
                            <img alt="" class="image-quote"
                                 src="{{ asset('theme/images/image-icons/icon-quote.png') }}">
                            <div class="client-title">
                                <span class="client-name">Anabella Kleva </span>
                                <span class="client-company">/ Managerment at Envato</span>
                            </div>
                            <p class="client-description">Sed elit quam, iaculis sed semper sit amet udin vitae
                                nibh. at magna akal semperFusce commodo molestie luctus.Lorem ipsum Dolor tusima
                                olatiup.</p>
                        </div>
                    </div>
                    <div class="client-carousel-item">
                        <img alt="" class="client-img" src="{{ asset('theme/images/clients/1-92x92.jpg') }}">
                        <div class="client-box">
                            <img alt="" class="image-quote"
                                 src="{{ asset('theme/images/image-icons/icon-quote.png') }}">
                            <div class="client-title">
                                <span class="client-name">Adam Stone</span>
                                <span class="client-company">/ CEO at Google INC</span>
                            </div>
                            <p class="client-description">Sed elit quam, iaculis sed semper sit amet udin vitae
                                nibh. at magna akal semperFusce commodo molestie luctus.Lorem ipsum Dolor tusima
                                olatiup. Sed elit quam, iaculis sed semper sit amet udin vitae nibh</p>
                        </div>
                    </div>
                    <div class="client-carousel-item">
                        <img alt="" class="client-img" src="{{ asset('teme/images/clients/2-92x92.jpg') }}">
                        <div class="client-box">
                            <img alt="" class="image-quote"
                                 src="{{ asset('theme/images/image-icons/icon-quote.png') }}">
                            <div class="client-title">
                                <span class="client-name">Adam Stone</span>
                                <span class="client-company">/ CEO at Google INC</span>
                            </div>
                            <p class="client-description">Sed elit quam, iaculis sed semper sit amet udin vitae
                                nibh. at magna akal semperFusce commodo molestie luctus.Lorem ipsum Dolor tusima
                                olatiup.</p>
                        </div>
                    </div>
                </div>
                <div class="partner-carousel owl-carousel">
                    <div class="partner-carousel-item">
                        <img alt="" src="{{ asset('theme/images/partners/1.png') }}">
                    </div>
                    <div class="partner-carousel-item">
                        <img alt="" src="{{ asset('theme/images/partners/2.png') }}">
                    </div>
                    <div class="partner-carousel-item">
                        <img alt="" src="{{ asset('theme/images/partners/3.png') }}">
                    </div>
                    <div class="partner-carousel-item">
                        <img alt="" src="{{ asset('theme/images/partners/4.png') }}">
                    </div>
                    <div class="partner-carousel-item">
                        <img alt="" src="{{ asset('theme/images/partners/5.png') }}">
                    </div>
                </div>
            </div>
        </section>

        <!-- Section News -->

        <section class="section-news section">
            <div class="container">
                <h2 class="section-title">Последние записи
                    <a href="{{ route('post.index') }}" class="link-arrow-2 pull-right">
                        Все статьи <i class="icon ion-ios-arrow-right"></i>
                    </a>
                </h2>
                <x-post-carousel :items="$posts" route="post.detail"></x-post-carousel>
            </div>
        </section>
    </div>
</x-layout>
