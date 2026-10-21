<?php

namespace App\Http\Controllers;

use App\Repositories\GameRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, GameRepository $gameRepository)
    {
        $gameName = $request->input('gameName');
        
        if (!$gameName || $gameName === '') {
            return redirect('/');
        }

        $games = $gameRepository->searchGames($gameName);

        return view('search', [
            'gameName' => $gameName,
            'games' => $games,
        ]);
    }
}