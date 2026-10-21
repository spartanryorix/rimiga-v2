<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class GameRepository
{
    private $steamStoreUrl = 'https://store.steampowered.com';

    public function getFeaturedCategories()
    {
        try {
            $url = "{$this->steamStoreUrl}/api/featuredcategories?cc=US&l=en";
            $response = Http::get($url);
            return $response->json();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getGameDetails(int $appId)
    {
        try {
            $url = "{$this->steamStoreUrl}/api/appdetails?appids={$appId}&cc=US&l=en";
            $response = Http::get($url);
            $data = $response->json();

            // Check if game exists and is successful
            if (!isset($data[$appId]['success']) || !$data[$appId]['success']) {
                return null;
            }

            return $data[$appId]['data'];
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getGamesByGenre(string $genreName, int $start = 0)
    {
        try {
            $url = "{$this->steamStoreUrl}/search/results?genre={$genreName}&json=1&start={$start}&count=50";
            $response = Http::get($url);
            $data = $response->json();

            return [
                'items' => $data['items'] ?? [],
                'total' => $data['total_count'] ?? 0,
                'count' => count($data['items'] ?? []),
            ];
        } catch (\Exception $e) {
            return [
                'items' => [],
                'total' => 0,
                'count' => 0,
            ];
        }
    }

    public function searchGames(string $query)
    {
        try {
            $query = urlencode($query);
            $url = "{$this->steamStoreUrl}/api/storesearch/?term={$query}&cc=US&l=en";
            $response = Http::get($url);
            $data = $response->json();

            return $data['items'] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }
}
