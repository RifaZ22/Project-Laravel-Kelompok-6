@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Sepatu</h2>

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

    <form action="{{ route('sepatu.update', $sepatu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" value="{{ $sepatu->nama }}" class="form-control" placeholder="Nama Sepatu">
        </div>

        <div class="form-group">
            <label for="merek">Merek</label>
            <input type="text" name="merek" value="{{ $sepatu->merek }}" class="form-control" placeholder="Merek Sepatu">
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" value="{{ $sepatu->harga }}" class="form-control" placeholder="Harga Sepatu">
        </div>

        <div class="form-group">
            <label for="ukuran">Ukuran</label>
            <input type="text" name="ukuran" value="{{ $sepatu->ukuran }}" class="form-control" placeholder="Ukuran Sepatu">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" placeholder="Deskripsi Sepatu">{{ $sepatu->deskripsi }}</textarea>
        </div>

        <!-- Jika nanti edit gambar diperlukan, tambahkan field -->
        <!-- <div class="form-group">
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div> -->

        <button type="submit" class="btn btn-primary mt-2">Perbarui</button>
    </form>
</div>
@endsection
