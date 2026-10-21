<?php

namespace App\Http\Controllers;

use App\Repositories\GameRepository;
use App\Models\Favourite;

class GameController extends Controller
{
    public function show($id, GameRepository $gameRepository)
    {
        // Fetch game details from Steam API
        $gameDetails = $gameRepository->getGameDetails($id);

        // If game doesn't exist, show 404
        if (!$gameDetails) {
            abort(404, 'Game not found');
        }

        // Check if logged-in user has favorited this game
        $isFavourited = false;
        if (auth()->check()) {
            $isFavourited = Favourite::where('user_id', auth()->id())
                ->where('game_id', $id)
                ->exists();
        }

        return view('game', [
            'game' => $gameDetails,
            'gameId' => $id,
            'isFavourited' => $isFavourited,
        ]);
    }
}