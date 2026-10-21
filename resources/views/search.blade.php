<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rimiga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/genreStyles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body class="body">
    @include('components.navbar')
    
    <div class="outerCard card" style="background-color: #1a1a2e;">
        <p class="heading-genre">Search Results for {{ str_replace('+', ' ', $gameName) }}</p>
        
        @if(empty($games))
            <p class="labels">Please enter a game.</p>
        @else
            <div class="container">
                <div class="row">
                    @foreach($games as $game)
                        <div class="col-3">
                            <a class="game-link" href="/game/{{ $game['id'] }}">
                                <div class="innerCard">
                                    <img class="storeImages" src="{{ $game['tiny_image'] }}" alt="{{ $game['name'] }}"/>
                                    <p class="labels">{{ $game['name'] }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>