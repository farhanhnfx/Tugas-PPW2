<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Galeri Buku') }}
        </h2>
    </x-slot>

    <section id="album" class="py-1 bg-light">
        <div class="container">
            <h1 class="h1 text-center">{{ $bukus->judul }}</h1>
            <hr>
            <br>
            <div class="row justify-content-around">
                @if(count($galeris) > 0)
                    <h4 class="h4">Kumpulan gambar:</h4>
                @else
                    <h4 class="h4">Tidak ada gambar tersedia.</h4>
                @endif
                @foreach ($galeris as $data)
                    <div class="col-md-4">
                        <a href="{{ $data->path }}" data-lightbox="image-1" data-title="{{ $data->keterangan }}">
                            <img src="{{ $data->path }}" class="img-thumbnail rounded">
                        </a>
                        <br>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $galeris->links() }}
        </div>
    </section>

</x-app-layout>
