@extends('layouts.app')

@section('content')
<div class="outerCard card">
    <p class="heading-genre">Games with the {{ str_replace('+', ' ', $genreName) }} Genre</p>
    
    <div class="row g-3 justify-content-center">
        @forelse($games as $game)
            @php
                // Extract app ID from the logo URL
                $parts = explode('/', $game['logo']);
                $appsKey = array_search('apps', $parts);
                $appId = $parts[$appsKey + 1];
                // Resize the logo
                $logo = str_replace('capsule_sm_120', 'capsule_231x87', $game['logo']);
            @endphp
            <div class="col-3">
                <a class="game-link" href="/game/{{ $appId }}">
                    <div class="innerCard">
                        <img src="{{ $logo }}" alt="{{ $game['name'] }}">
                        <p class="labels">{{ $game['name'] }}</p>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <p class="labels">No games found for this genre.</p>
            </div>
        @endforelse
    </div>

    <div class="pagination">
        @if($start > 0)
            <a href="/genre?genreName={{ urlencode($genreName) }}&start={{ $prevStart }}">Prev</a>
        @endif
        @if($itemCount == 50)
            <a href="/genre?genreName={{ urlencode($genreName) }}&start={{ $nextStart }}">Next</a>
        @endif
    </div>
</div>
<br>
@endsection