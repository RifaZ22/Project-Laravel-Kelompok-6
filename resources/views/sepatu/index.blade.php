@extends('layoutcrud')


@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Sepatu</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('sepatu.create') }}" class="btn btn-primary mb-3">+ Tambah Sepatu</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Merek</th>
                <th>Harga</th>
                <th>Ukuran</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $s)
            <tr>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->merek }}</td>
                <td>Rp {{ number_format($s->harga, 0, ',', '.') }}</td>
                <td>{{ $s->ukuran }}</td>
                <td>
                    @if($s->gambar)
                        <img src="{{ asset('storage/' . $s->gambar) }}" width="60" alt="{{ $s->nama }}">
                    @else
                        <em>Belum ada</em>
                    @endif
                </td>
                <td>
                    <a href="{{ route('sepatu.edit', $s->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('sepatu.destroy', $s->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
