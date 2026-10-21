<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function toggle(Request $request)
    {
    if (!auth()->check()) {
        return redirect('/login');
    }

    $gameId = $request->input('game_id');
    $returnTo = $request->input('returnTo', 'game');  // Default to 'game'
    $userId = auth()->id();

    $favourite = Favourite::where('user_id', $userId)
        ->where('game_id', $gameId)
        ->first();

    if ($favourite) {
        $favourite->delete();
    } else {
        Favourite::create([
            'user_id' => $userId,
            'game_id' => $gameId,
        ]);
    }

    // Redirect based on where the request came from
    if ($returnTo === 'favourites') {
        return redirect('/favourites');
    } else {
        return redirect("/game/{$gameId}");
    }
    }
}