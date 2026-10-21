@extends('layouts.app')

@section('content')
<div class="outerCard card">
    <p class="heading-genre">Your Favourites</p>

    @if(count($games) > 0)
        @foreach($games as $game)
            <div class="innerCard fav-row">
                <div class="row align-items-center">
                    <div class="col-3">
                        <a href="/game/{{ $game['game_id'] }}">
                            <img src="{{ $game['details']['header_image'] ?? '' }}" alt="{{ $game['details']['name'] }}">
                        </a>
                    </div>
                    <div class="col-6">
                        <a class="game-link" href="/game/{{ $game['game_id'] }}">
                            <p class="labels fav-name">{{ $game['details']['name'] }}</p>
                        </a>
                        <p class="labels fav-desc">{{ $game['details']['short_description'] ?? '' }}</p>
                        @if(!empty($game['details']['genres']))
                            <div class="genre-list">
                                @foreach($game['details']['genres'] as $genre)
                                    <span class="genre-tag">{{ $genre['description'] }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="col-3 text-end">
                        <p class="labels fav-price">{{ $game['details']['price_overview']['final_formatted'] ?? 'Free' }}</p>
                        <form method="post" action="/favorite">
                            @csrf
                            <input type="hidden" name="game_id" value="{{ $game['game_id'] }}">
                            <input type="hidden" name="returnTo" value="favourites">
                            <button class="removeBtn" type="submit">Remove from Favourites</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="labels">You haven't favourited any games yet.</p>
    @endif
</div>
<br>
@endsection