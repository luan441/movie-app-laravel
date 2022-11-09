<?php

namespace App\Http\Controllers;

use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class MovieController extends Controller
{
    public function index(Request $request): View
    {
        $page = intval($request->input('page') ?? 1);
        $query = $request->input('query') ?? '';

        if ($query) {
            $response = Http::get('https://api.themoviedb.org/3/search/movie', [
                'api_key' => $_ENV['API_KEY'],
                'page' => $page,
                'query' => $query,
            ]);
        } else {
            $response = Http::get('https://api.themoviedb.org/3/discover/movie', [
                'api_key' => $_ENV['API_KEY'],
                'page' => $page,
                'sort_by' => 'release_date.desc',
                'release_date.lte' => (new DateTimeImmutable())->format('Y-m-d'),
            ]);
        }

        return view('movie.index', [
            'movies' => $response->json()['results'],
            'page' => $page,
            'totalPages' => $response->json()['total_pages'],
            'query' => $query,
        ]);
    }
    
    public function show(int $movieId): View
    {
        $response = Http::get('https://api.themoviedb.org/3/movie/'.$movieId, [
            'api_key' => $_ENV['API_KEY'],
        ]);
        $movie = $response->json();

        $response = Http::get('https://api.themoviedb.org/3/movie/'.$movieId.'/credits', [
            'api_key' => $_ENV['API_KEY'],
        ]);
        $credits = $response->json();

        return view('movie.show', [
            'movie' => $movie,
            'credits' => $credits
        ]);
    }
}
