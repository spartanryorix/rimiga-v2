<?php

namespace App\Http\Controllers;

use App\Repositories\GameRepository;

class HomeController extends Controller
{
    /**
     * Show the homepage with featured games
     */
    public function index(GameRepository $gameRepository)
    {
    $featuredData = $gameRepository->getFeaturedCategories();

    return view('home', [
        'catData' => $featuredData,
    ]);
    }
}