<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Repositories\GameRepository;

class FavouritesController extends Controller
{
    public function index(GameRepository $gameRepository)
    {
        // Only logged-in users can see their favorites
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Get all favorites for this user
        $favourites = Favourite::where('user_id', auth()->id())->get();

        // Fetch full game details for each favorite
        $games = [];
        foreach ($favourites as $favourite) {
            $gameDetails = $gameRepository->getGameDetails($favourite->game_id);
            if ($gameDetails) {
                $games[] = [
                    'game_id' => $favourite->game_id,
                    'details' => $gameDetails,
                ];
            }
        }

        return view('favourites', [
            'games' => $games,
        ]);
    }
}