<x-layout>
    <x-slot:title>Filmes</x-slot:title>
    <x-navbar />
    <div class="bg-light py-5 mt-5">
        <div class="container">
            <div class="grid-cols">
                @foreach ($movies as $movie)
                <div class="card">
                    @if ($movie['poster_path'])
                    <img src="https://image.tmdb.org/t/p/original{{ $movie['poster_path'] }}" class="card-img-top" alt="...">
                    @else
                    <img src="{{ Vite::asset('resources/images/no_image.png') }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie['title'] }}</h5>
                        <p class="card-text">
                            popularidade: {{ $movie['popularity'] }} <br>
                            Data de lançamento: {{ $movie['release_date'] }}
                        </p>
                        <a href="/{{ $movie['id'] }}" class="btn btn-dark">Ver Detalhes</a>
                    </div>
                </div>
                @endforeach
            </div> 
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    @if($page === 1)
                    <li class="page-item disabled">
                        <a class="page-link">Anterior</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link text-bg-dark border-dark" href="http://localhost/?page={{ $page - 1 }}">Anterior</a>
                    </li>
                    @endif

                    <li class="page-item active"><span class="page-link text-bg-secondary border-secondary">{{ $page }}</span></li>
                    @if(($page + 1) < $totalPages)
                    <li class="page-item"><a class="page-link text-dark" href="http://localhost/?page={{ $page + 1 }}">{{ $page + 1 }}</a></li>
                    @endif
                    @if(($page + 2) < $totalPages)
                    <li class="page-item"><a class="page-link text-dark" href="http://localhost/?page={{ $page + 2 }}">{{ $page + 2 }}</a></li>
                    @endif

                    @if($page === $totalPages)
                    <li class="page-item disabled">
                        <a class="page-link">Proximo</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link text-bg-dark border-dark" href="http://localhost/?page={{ $page + 1 }}">Proximo</a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</x-layout>
