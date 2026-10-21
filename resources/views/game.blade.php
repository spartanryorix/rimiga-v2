@extends('layouts.app')

@section('content')
<div class="game-page">
    
    @if($game['name'])
        <p class="game-title">{{ $game['name'] }}</p>
    @endif

    <div class="game-container">

        <!-- LEFT COLUMN -->
        <div class="row">
            <div class="game-left col-7">

                <!-- MAIN PLAYER -->
                <div class="main-player">
                    @if(!empty($game['movies']))
                        <video class="main-video" id="main-player" autoplay muted controls 
                            data-hls="{{ $game['movies'][0]['hls_h264'] }}">
                        </video>
                    @elseif(!empty($game['screenshots']))
                        <img class="main-media" src="{{ $game['screenshots'][0]['path_full'] }}"/>
                    @else
                        <p class="labels">No media available.</p>
                    @endif
                </div>

                <!-- THUMBNAIL ROW -->
                <div class="thumbnail-container">
                    <button class="thumb-prev"><i class="bi bi-caret-left-fill"></i></button>
                    <div class="thumbnail-row">
                        @foreach($game['movies'] ?? [] as $movie)
                            <div class="thumbnail video-thumb" 
                                data-type="video" 
                                data-src="{{ $movie['hls_h264'] }}"
                                data-thumb="{{ $movie['thumbnail'] }}">
                                <img src="{{ $movie['thumbnail'] }}"/>
                            </div>
                        @endforeach
                        @foreach($game['screenshots'] ?? [] as $shot)
                            <div class="thumbnail shot-thumb" 
                                data-type="image" 
                                data-src="{{ $shot['path_full'] }}">
                                <img src="{{ $shot['path_thumbnail'] }}"/>
                            </div>
                        @endforeach
                    </div>
                    <button class="thumb-next"><i class="bi bi-caret-right-fill"></i></button>
                </div>

            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="game-right col-5">

            @if($game['header_image'])
                <img class="game-header-img" src="{{ $game['header_image'] }}"/>
            @endif

            @if($game['short_description'])
                <p class="labels game-short-desc">{{ $game['short_description'] }}</p>
            @endif

            @if($game['release_date']['date'] ?? null)
                <p class="labels"><b>Release Date:</b> {{ $game['release_date']['date'] }}</p>
            @endif

            @if($game['developers'][0] ?? null)
                <p class="labels"><b>Developer:</b> {{ $game['developers'][0] }}</p>
            @endif

            @if($game['publishers'][0] ?? null)
                <p class="labels"><b>Publisher:</b> {{ $game['publishers'][0] }}</p>
            @endif

            @if(!empty($game['genres']))
                <div class="genre-list">
                    @foreach($game['genres'] as $genre)
                        @php
                            $genreNameFixes = [
                                'Free To Play' => 'Free to Play',
                            ];
                            $genreLinkName = $genreNameFixes[$genre['description']] ?? $genre['description'];
                        @endphp
                        <a href="/genre?genreName={{ urlencode($genreLinkName) }}" class="genre-tag">{{ $genre['description'] }}</a>
                    @endforeach
                </div>
            @endif

            <div style="display: flex;">
                @if($game['release_date']['coming_soon'] == true)
                    <p class="game-price">TBD</p>
                @elseif($game['price_overview']['final_formatted'] ?? null)
                    <p class="game-price">{{ $game['price_overview']['final_formatted'] }}</p>
                @else
                    <p class="game-price">Free</p>
                @endif
                @if($game['price_overview']['initial_formatted'] ?? null)
                    <p class="game-price-initial"><s>{{ $game['price_overview']['initial_formatted'] }}</s></p>
                @endif
            </div>

            @if(auth()->check())
                <form method="post" action="/favorite">
                    @csrf
                    <input type="hidden" name="game_id" value="{{ $gameId }}">
                    <input type="hidden" name="returnTo" value="game">
                    @if($isFavourited)
                        <button class="fav-btn w-100" type="submit"><i class="bi bi-dash-circle-fill" style="align-items: center; margin-right: 5px;"></i>Remove from Favourites</button>
                    @else
                        <button class="fav-btn w-100" type="submit"><i class="bi bi-plus-circle-fill" style="align-items: center; margin-right: 5px;"></i>Add to Favourites</button>
                    @endif
                </form>
            @else
                <a href="/login"><button class="fav-btn w-100" type="button"><i class="bi bi-plus-circle-fill" style="align-items: center; margin-right: 5px;"></i>Add to Favourites</button></a>
            @endif
            <a href="https://store.steampowered.com/app/{{ $gameId }}"><button class="steam-btn w-100" type="button"><i class="bi bi-steam" style="align-items: center; margin-right: 5px;"></i>View on Steam</button></a>
        </div>
    </div>
    <br>

    <div class="game-container2">
        <!-- LONG DESCRIPTION -->
        <div class="col">
            @if($game['detailed_description'] ?? null)
                <div class="long-desc">
                    {!! str_replace('</h2><br>', '</h2>', $game['detailed_description']) !!}
                </div>
            @endif
        </div>
        <div class="col">
            <div class="row">
                @if(!empty($game['categories']))
                    <div class="cat-card genre-list">
                        <p class="subHeading-left">Categories</p><br>
                        <div class="categories">
                            @foreach($game['categories'] as $category)
                                <span class="cat-tag">{{ $category['description'] }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <br>
            <div class="row">
                @if($game['pc_requirements']['minimum'] ?? null || $game['pc_requirements']['recommended'] ?? null)
                    <br>
                    <div class="pc-requirements">
                        <p class="subHeading-left">PC Requirements</p>
                        <div class="row">
                            {!! $game['pc_requirements']['minimum'] ?? '' !!}
                        </div>
                        <div class="row">
                            {!! $game['pc_requirements']['recommended'] ?? '' !!}
                        </div>
                    </div>
                @endif
            </div>
            <br>
            <div class="row">
                @if($game['supported_languages'] ?? null)
                    <div class="pc-requirements">
                        <p class="subHeading-left">Languages</p>
                        <div class="categories">
                            @php
                                $langList = explode(',', strip_tags($game['supported_languages']));
                            @endphp
                            @foreach($langList as $lang)
                                <span class="cat-tag">{{ trim($lang) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <br>
            <div class="row">
                @if($game['ratings']['pegi']['rating'] ?? null)
                    <div class="pc-requirements">
                        <p class="labels">PEGI {{ strtoupper($game['ratings']['pegi']['rating']) }}</p>
                        @if($game['ratings']['pegi']['descriptors'] ?? null)
                            <div class="categories">
                                @foreach(explode("\n", $game['ratings']['pegi']['descriptors']) as $descriptor)
                                    @if(trim($descriptor))
                                        <span class="cat-tag">{{ trim($descriptor) }}</span>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        <br>
                        @php
                            $contentWarning = str_replace(["\r\n", "\n", "\r"], ', ', $game['content_descriptors']['notes'] ?? null);
                        @endphp
                        @if($contentWarning)
                            <div>
                                <p class="labels">{{ $contentWarning }}</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
            <br>
        </div>
    </div>
    <br>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>
    const video = document.getElementById('main-player');
    if (video && Hls.isSupported()) {
        const hls = new Hls();
        hls.loadSource(video.getAttribute('data-hls'));
        hls.attachMedia(video);
    }

    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const src = this.getAttribute('data-src');
            const playerContainer = document.querySelector('.main-player');

            if (type === 'video') {
                playerContainer.innerHTML = '<video class="main-video" id="main-player-video" autoplay muted controls></video>';
                const video = document.getElementById('main-player-video');
                if (Hls.isSupported()) {
                    const hls = new Hls();
                    hls.loadSource(src);
                    hls.attachMedia(video);
                }
            } else {
                playerContainer.innerHTML = '<img class="main-media" src="' + src + '"/>';
            }

            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active-thumb'));
            this.classList.add('active-thumb');
        });
    });

    const thumbRow = document.querySelector('.thumbnail-row');
    const thumbPrev = document.querySelector('.thumb-prev');
    const thumbNext = document.querySelector('.thumb-next');
    const scrollAmount = 136;

    thumbNext.addEventListener('click', () => {
        thumbRow.scrollLeft += scrollAmount;
    });

    thumbPrev.addEventListener('click', () => {
        thumbRow.scrollLeft -= scrollAmount;
    });
</script>
@endsection