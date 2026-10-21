<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rimiga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body class="body">
    @include('components.navbar')
    <div class="site-starfield">
        <div class="starLayer1"></div>
        <div class="starLayer2"></div>
        <div class="starLayer3"></div>
    </div>

    <div class="hero-section">
        <div class="hero-carousel">
            <div class="scene">
                @php
                    $catSpecial = $catData['specials']['items'] ?? [];
                    $loopedCarousel = [];
                    $ci = 0;
                @endphp
                <div class="a3d" style="--n: {{ count($catSpecial) }}">
                    <div class="a3d" style="--n: {{ count(array_filter($catSpecial, function($game) use (&$loopedCarousel) { 
                        if (!in_array($game['id'], $loopedCarousel)) { 
                            $loopedCarousel[] = $game['id']; 
                            return true; 
                        } 
                        return false; 
                    })) }}">
                        @php
                            $loopedCarousel = [];
                        @endphp
                        @foreach($catSpecial as $carouselGame)
                            @if(!in_array($carouselGame['id'], $loopedCarousel))
                                @php
                                    $loopedCarousel[] = $carouselGame['id'];
                                @endphp
                                <img class="c-card-img" src="{{ $carouselGame['header_image'] }}" style="--i: {{ $loop->index }}" alt="{{ $carouselGame['name'] }}"/>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-text">
            <h1 class="heading" id="title"><span>Rimiga</span></h1>
            <p class="subHeading" id="title"><span>Dive into the realm of PC gaming</span></p>
        </div>
    </div>
    <br>
    <br>

    <div class="container-fluid d-flex justify-content-center">
        <div class="card outerCard">
            <p class="labelHeading">{{ $catData['top_sellers']['name'] ?? 'Top Sellers' }}</p>
            <br>
            <div class="card carousel-card">
                <div class="container-fluid mx-auto">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @php
                                $catGameData = $catData['top_sellers']['items'] ?? [];
                                $loopedIDs = [];
                                $i = 0;
                            @endphp
                            @foreach($catGameData as $catGames)
                                @if(!in_array($catGames['id'], $loopedIDs))
                                    @php
                                        $loopedIDs[] = $catGames['id'];
                                        $i++;
                                        $class = ($i == 1) ? "carousel-item active c-item" : "carousel-item c-item";
                                    @endphp
                                    <div class="{{ $class }}">
                                        <div class="row align-items-center">
                                            <div class="row align-items-start">
                                                <div class="col-8">
                                                    <div class="c-item">
                                                        <a href="/game/{{ $catGames['id'] }}">
                                                            <div class="img-wrapper">
                                                                @php
                                                                    $gameDetails = app(App\Repositories\GameRepository::class)->getGameDetails($catGames['id']);
                                                                    $videoURL = !empty($gameDetails['movies']) ? $gameDetails['movies'][0]['hls_h264'] : null;
                                                                @endphp
                                                                <img class="c-img-main d-block w-100" 
                                                                    src="{{ $catGames['large_capsule_image'] }}" 
                                                                    data-video="{{ $videoURL }}"
                                                                    alt="{{ $catGames['name'] }}"/>                                                            
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @php
                                                    $gameDetails = app(App\Repositories\GameRepository::class)->getGameDetails($catGames['id']);
                                                    $screenshots = $gameDetails['screenshots'] ?? [];
                                                    $shotCount = count($screenshots);
                                                @endphp
                                                <div class="col-4">
                                                    @if($shotCount > 0)
                                                        <div class="row g-2">
                                                            <div class="col"><img class="c-img-thumb d-block w-100" src="{{ $screenshots[0]['path_thumbnail'] ?? '' }}"/></div>
                                                            <div class="col">
                                                                @if($shotCount > 1)
                                                                    <img class="c-img-thumb d-block w-100" src="{{ $screenshots[1]['path_thumbnail'] }}"/>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row g-2">
                                                            <div class="col">
                                                                @if($shotCount > 2)
                                                                    <img class="c-img-thumb d-block w-100" src="{{ $screenshots[2]['path_thumbnail'] }}"/>
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                @if($shotCount > 3)
                                                                    <img class="c-img-thumb d-block w-100" src="{{ $screenshots[3]['path_thumbnail'] }}"/>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="no-screenshots">No screenshots available</div>
                                                    @endif
                                                    <p class="labels gameDescription">{{ $gameDetails['short_description'] ?? '' }}</p>
                                                    @php $gameGenres = $gameDetails['genres'] ?? []; @endphp
                                                    @if(count($gameGenres) > 0)
                                                        <div class="genre-list">
                                                            @foreach($gameGenres as $genre)
                                                                <span class="genre-tag">{{ $genre['description'] }}</span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                                <p class="labels gameName">{{ $catGames['name'] }}</p>
                                            </div>
                                            <div class="col-4">
                                                <p class="gamePrice">{{ $gameDetails['price_overview']['final_formatted'] ?? 'Free' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="container-fluid d-flex justify-content-center">
        <div class="card outerCard">
            <p class="labelHeading">{{ $catData['specials']['name'] ?? 'Specials' }}</p>
            <br>
            <div class="specials-shelf">
                @php
                    $specialItems = $catData['specials']['items'] ?? [];
                    $loopedSpecialIDs = [];
                @endphp
                @foreach($specialItems as $item)
                    @if(!in_array($item['id'], $loopedSpecialIDs))
                        @php
                            $loopedSpecialIDs[] = $item['id'];
                            $discount = $item['discount_percent'] ?? 0;
                            $originalPrice = isset($item['original_price']) ? number_format($item['original_price'] / 100, 2) : null;
                            $finalPrice = isset($item['final_price']) ? number_format($item['final_price'] / 100, 2) : null;
                            $image = $item['large_capsule_image'] ?? $item['header_image'] ?? '';
                        @endphp
                        <a href="/game/{{ $item['id'] }}" class="special-card">
                            <div class="special-img-wrap">
                                <img class="special-img" src="{{ $image }}" alt="{{ $item['name'] }}"/>
                                @if($discount > 0)
                                    <span class="discount-badge">-{{ $discount }}%</span>
                                @endif
                            </div>
                            <p class="labels special-title">{{ $item['name'] }}</p>
                            <div class="special-price-row">
                                @if($discount > 0 && $originalPrice)
                                    <span class="special-price-original">${{ $originalPrice }}</span>
                                @endif
                                <span class="special-price-final">{{ $finalPrice !== null ? '$' . $finalPrice : 'Free' }}</span>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <br>

    <div class="container-fluid d-flex justify-content-center">
        <div class="card outerCard">
            <p class="labelHeading">{{ $catData['coming_soon']['name'] ?? 'Coming Soon' }}</p>
            <br>
            <div class="release-list">
                @php
                    $comingSoonItems = $catData['coming_soon']['items'] ?? [];
                    $loopedComingSoonIDs = [];
                @endphp
                @foreach($comingSoonItems as $item)
                    @if(!in_array($item['id'], $loopedComingSoonIDs))
                        @php
                            $loopedComingSoonIDs[] = $item['id'];
                            $gameDetails = app(App\Repositories\GameRepository::class)->getGameDetails($item['id']);
                            $releaseInfo = $gameDetails['release_date']['date'] ?? 'TBA';
                            $genres = $gameDetails['genres'] ?? [];
                            $image = $item['large_capsule_image'] ?? $item['header_image'] ?? '';
                        @endphp
                        <a href="/game/{{ $item['id'] }}" class="release-row">
                            <img class="release-thumb" src="{{ $image }}" alt="{{ $item['name'] }}"/>
                            <div class="release-info">
                                <p class="labels release-title">{{ $item['name'] }}</p>
                                @if(count($genres) > 0)
                                    <div class="genre-list">
                                        @foreach($genres as $genre)
                                            <span class="genre-tag">{{ $genre['description'] }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <span class="release-date-pill">{{ $releaseInfo }}</span>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <br>

    <div class="container-fluid d-flex justify-content-center">
        <div class="card outerCard">
            <p class="labelHeading">{{ $catData['new_releases']['name'] ?? 'New Releases' }}</p>
            <br>
            <div class="new-releases-grid">
                @php
                    $newReleaseItems = $catData['new_releases']['items'] ?? [];
                    $loopedNewReleaseIDs = [];
                @endphp
                @foreach($newReleaseItems as $item)
                    @if(!in_array($item['id'], $loopedNewReleaseIDs))
                        @php
                            $loopedNewReleaseIDs[] = $item['id'];
                            $gameDetails = app(App\Repositories\GameRepository::class)->getGameDetails($item['id']);
                            $releaseInfo = $gameDetails['release_date']['date'] ?? 'TBA';
                            $genres = $gameDetails['genres'] ?? [];
                            $image = $item['large_capsule_image'] ?? $item['header_image'] ?? '';
                        @endphp
                        <a href="/game/{{ $item['id'] }}" class="new-release-card">
                            <div class="new-release-img-wrap">
                                <img class="new-release-img" src="{{ $image }}" alt="{{ $item['name'] }}"/>
                                <span class="new-badge">NEW</span>
                            </div>
                            <p class="labels new-release-title">{{ $item['name'] }}</p>
                            <p class="labels new-release-date">Released: {{ $releaseInfo }}</p>
                            @if(count($genres) > 0)
                                <div class="genre-list">
                                    @foreach($genres as $genre)
                                        <span class="genre-tag">{{ $genre['description'] }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script>
        document.addEventListener('mouseenter', function(e) {
            const wrapper = e.target.classList.contains('img-wrapper') ? e.target : null;
            if (!wrapper) return;

            const img = wrapper.querySelector('.c-img-main');
            if (!img) return;

            const videoURL = img.getAttribute('data-video');
            if (!videoURL) return;

            const video = document.createElement('video');
            video.className = 'hover-video';
            video.autoplay = true;
            video.muted = true;
            video.loop = true;

            if (Hls.isSupported()) {
                const hls = new Hls();
                hls.loadSource(videoURL);
                hls.attachMedia(video);
                video._hls = hls;
            }

            wrapper.appendChild(video);
        }, true);

        document.addEventListener('mouseleave', function(e) {
            const wrapper = e.target.classList.contains('img-wrapper') ? e.target : null;
            if (!wrapper) return;

            const video = wrapper.querySelector('.hover-video');
            if (video) {
                if (video._hls) video._hls.destroy();
                video.remove();
            }
        }, true);

        document.addEventListener('mouseenter', function(event) {
            const wrapper = event.target.classList.contains('c-img-thumb') ? event.target : null;
            if (!wrapper) return;

            const imgThumb = event.target.getAttribute('src');
            if (!imgThumb) return;

            const mainClass = event.target.closest('.align-items-start');
            const imgMain = mainClass.querySelector('.c-img-main');
            const mainSRC = imgMain.getAttribute('src');
            imgMain.setAttribute('data-original-src', mainSRC);     
            imgMain.src = imgThumb;
        }, true);

        document.addEventListener('mouseleave', function(event){
            const wrapper = event.target.classList.contains('c-img-thumb') ? event.target : null;
            if (!wrapper) return;

            const mainClass = event.target.closest('.align-items-start');
            const imgMain = mainClass.querySelector('.c-img-main');
            imgMain.getAttribute('data-original-src');
            imgMain.src = imgMain.getAttribute('data-original-src');
        }, true);
    </script>
</body>
</html>