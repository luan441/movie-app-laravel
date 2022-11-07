<x-layout>
    <x-slot:title>{{ $movie['title'] }}</x-slot:title>
    <x-navbar />
    <div class="bg-light py-5 h-100">
        <div class="container py-5">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if ($movie['poster_path'])
                            <img src="https://image.tmdb.org/t/p/original{{ $movie['poster_path'] }}" class="card-img-top" alt="...">
                        @else
                            <img src="{{ Vite::asset('resources/images/no_image.png') }}" class="card-img-top" alt="...">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie['title'] }}</h5>
                            <p class="card-text">
                                @foreach ($movie['genres'] as $genres)
                                    <span class="badge text-bg-dark">{{ $genres['name'] }}</span>
                                @endforeach
                            </p>
                            <p class="card-text">
                                @if ($movie['overview'])
                                    {{ $movie['overview'] }}
                                @else
                                    Sem descrição.
                                @endif
                            </p>
                            <p class="card-text">
                                <ul class="list-group">
                                    <li class="list-group-item"><b>Status:</b> {{ $movie['status'] }}</li>
                                    <li class="list-group-item"><b>Nota:</b> {{ $movie['vote_average'] }}</li>
                                    <li class="list-group-item"><b>Qtd:</b> {{ $movie['vote_count'] }}</li>
                                </ul>
                            </p>
                            <p class="card-text"><small class="text-muted">Data de lançamento: {{ $movie['release_date'] }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-cols">
            @foreach ($credits['crew'] as $people)
                <div class="card text-bg-dark">
                        @if ($people['profile_path'])
                            <img src="https://image.tmdb.org/t/p/original{{ $people['profile_path'] }}" class="card-img-top" alt="...">
                        @else
                            <img src="{{ Vite::asset('resources/images/no_image.png') }}" class="card-img-top" alt="...">
                        @endif
                    <div class="card-img-overlay">
                        <h5 class="card-title">{{ $people['name'] }}</h5>
                        <p class="card-text"><small>{{ $people['job'] }}</small></p>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</x-layout>
