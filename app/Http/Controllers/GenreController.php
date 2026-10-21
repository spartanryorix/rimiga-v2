<?php

namespace App\Http\Controllers;

use App\Repositories\GameRepository;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function show(Request $request, GameRepository $gameRepository)
    {
        $genreName = $request->input('genreName');
        $start = $request->input('start', 0);
        
        if (!$genreName) {
            abort(404, 'Genre not found');
        }

        // Fetch games for this genre
        $result = $gameRepository->getGamesByGenre($genreName, $start);

        $prevStart = $start - 50;
        $nextStart = $start + 50;
        $itemCount = count($result['items']);

        return view('genre', [
            'genreName' => $genreName,
            'games' => $result['items'],
            'start' => $start,
            'prevStart' => $prevStart,
            'nextStart' => $nextStart,
            'itemCount' => $itemCount,
        ]);
    }
}