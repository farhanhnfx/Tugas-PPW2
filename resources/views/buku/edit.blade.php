
<div class="container">
        <h4>Edit Buku</h4>
        <form method="POST" action="{{ route('buku.update', $buku->id) }}">
        @csrf
            <div>Judul <input type="text" name="judul" value="{{ $buku->judul }}"></div>
            <div>Penulis <input type="text" name="penulis" value="{{ $buku->penulis }}"></div>
            <div>Harga <input type="text" name="harga" value="{{ $buku->harga }}"></div>
            <div>Tanggal Terbit <input type="date" name="tgl_terbit" value="{{ $buku->tgl_terbit }}"></div>
            <div>
                <button type="submit">Simpan</button>
                <a href="/buku">Batal</a>
            </div>
        </form>
    </div>