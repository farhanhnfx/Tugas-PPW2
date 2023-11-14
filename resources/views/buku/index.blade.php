<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Buku') }}
        </h2>
    </x-slot>

    {{-- <x-slot name="slot"> --}}
{{-- @section('page-title', 'Data Buku')
@section('content') --}}
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="container">
                    @if(Session::has('pesan'))
                        <div class="alert alert-success">{{Session::get('pesan')}}</div>
                    @endif
                    <form align='right' action="{{ route('buku.search') }}" method="GET" class="d-flex" role="search">
                        @csrf
                        <input class="form-control me-2" type="search" name="kata" placeholder="Cari judul atau penulis..." aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Cari</button>
                    </form><br>

                    @if (Auth::user()->level == 'admin')
                        <p align='right'><a class="btn btn-success" href="{{ route('buku.create') }}">Tambah Buku</a></p>
                    @endif

                    @if ($isCari)
                        @if (count($data_buku))
                            <div class="alert alert-success">Ditemukan <strong>{{ count($data_buku) }}</strong> data dengan kata: <strong>{{ $cari }}</strong></div>
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Buku</th>
                                    <th>Penulis</th>
                                    <th>Harga</th>
                                    <th>Tanggal Terbit</th>
                                    @if (Auth::user()->level == 'admin')
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                                @foreach($data_buku as $buku)
                                    <tr>
                                        <td>{{ ++$no }}.</td>
                                        <td>
                                            @if ($buku->filepath)
                                                <div class='relative h-10 w-10'>
                                                    <img class='h-full w-full rounded-full object-cover object-center'
                                                        src='{{ $buku->filepath }}' alt='abc'>
                                                </div>
                                            @endif
                                            {{ $buku->judul }}
                                        </td>
                                        <td>{{ $buku->penulis }}</td>
                                        <td>Rp{{ number_format($buku->harga, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                                        @if (Auth::user()->level == 'admin')
                                            <td class="d-flex flex-row gap-1">
                                                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                                    @csrf
                                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin mau dihapus?')">Hapus</button>
                                                </form>
                                                <a class="btn btn-secondary" href="{{ route('buku.edit', $buku->id) }}">Edit</a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>
                            <div>
                                {{ $data_buku->links() }}
                            </div>
                        @else
                            <div class="alert alert-warning"><h4>Data {{ $cari }} tidak ditemukan</h4>
                            <a href="/buku" class="btn btn-warning">Kembali</a></div>
                        @endif
                    @else
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>No</th>
                                <th>Thumbnail</th>
                                <th>Buku</th>
                                <th>Penulis</th>
                                <th>Harga</th>
                                <th>Tanggal Terbit</th>
                                @if (Auth::user()->level == 'admin')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                            @foreach($data_buku as $buku)
                                <tr>
                                    <td>{{ ++$no }}.</td>
                                    <td>
                                        @if ($buku->filepath)
                                            <div class='relative h-240 w-320'>
                                                <img class='h-full w-full object-cover object-center'
                                                    src='{{ $buku->filepath }}' alt='abc'>
                                            </div>
                                        @endif</td>
                                    <td>
                                        {{ $buku->judul }}
                                    </td>
                                    <td>{{ $buku->penulis }}</td>
                                    <td>Rp{{ number_format($buku->harga, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                                    @if (Auth::user()->level == 'admin')
                                        <td class="d-flex flex-row gap-1">
                                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                                @csrf
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin mau dihapus?')">Hapus</button>
                                            </form>
                                            <a class="btn btn-secondary" href="{{ route('buku.edit', $buku->id) }}">Edit</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                        <div>
                            {{ $data_buku->links() }}
                        </div>
                    @endif
                </div>
                <div class="container">
                    <p>Jumlah Data: {{ $no }}</p>
                    <p>Total Harga: Rp{{ number_format($total_harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
    {{-- </x-slot> --}}

</x-app-layout>
