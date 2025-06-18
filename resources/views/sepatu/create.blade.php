@extends('layoutcrud')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Sepatu</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> Terjadi masalah pada input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sepatu.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama sepatu" value="{{ old('nama') }}">
        </div>

        <div class="mb-3">
            <label for="merek" class="form-label">Merek</label>
            <input type="text" name="merek" class="form-control" placeholder="Masukkan merek sepatu" value="{{ old('merek') }}">
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" placeholder="Masukkan harga sepatu" value="{{ old('harga') }}">
        </div>

        <div class="mb-3">
            <label for="ukuran" class="form-label">Ukuran</label>
            <input type="text" name="ukuran" class="form-control" placeholder="Masukkan ukuran sepatu" value="{{ old('ukuran') }}">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" placeholder="Masukkan deskripsi sepatu">{{ old('deskripsi') }}</textarea>
        </div>

        <!-- Jika nantinya ingin menambahkan opsi upload gambar, bisa tambahkan field file -->
        <!--
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        -->

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('sepatu.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
