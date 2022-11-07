<?php

namespace App\Http\Controllers;

use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $page = intval($request->input('page') ?? 1);
        $response = Http::get('https://api.themoviedb.org/3/discover/movie', [
            'api_key' => $_ENV['API_KEY'],
            'language' => 'pt-BR',
            'page' => $page,
            'sort_by' => 'release_date.desc',
            'release_date.lte' => (new DateTimeImmutable())->format('Y-m-d'),
        ]);

        return view('home.index', [
            'movies' => $response->json()['results'],
            'page' => $page,
            'totalPages' => $response->json()['total_pages']
        ]);
    }
}
