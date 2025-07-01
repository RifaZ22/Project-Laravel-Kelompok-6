<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Produk Sepatu - Enamour.id</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">
  <style>
    body { background: #f8f9fa; }
    .card { border-radius: .75rem; box-shadow: 0 .5rem 1rem rgba(0,0,0,0.1); }
    .table-hover tbody tr:hover { background: rgba(0,0,0,0.03); }

    /* biar tabel tetap nampung thumbnail melebar saat hover */
    .table-responsive { overflow: visible; }

    /* gaya thumbnail + animasi */
    .img-thumb {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: .25rem;
      transition: transform .2s ease-in-out;
      cursor: zoom-in;
      position: relative;
      z-index: 1;
    }

    /* perbesar dan bawa di atas elemen lain saat hover */
    .img-thumb:hover {
      transform: scale(3);
      z-index: 999;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center
                      bg-dark text-white">
        <h2 class="h5 mb-0">Daftar Produk</h2>
        <a href="{{ route('products.create') }}" class="btn btn-success">
          <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </a>
      </div>
      <div class="card-body">
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th class="text-end">Harga</th>
                <th class="text-center">Stok</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($products as $p)
                <tr>
                  <td>
                    @if($p->image)
                      <img
                        src="{{ asset('storage/'.$p->image) }}"
                        class="img-thumb"
                        alt="{{ $p->name }}">
                    @else
                      <span class="text-muted">–</span>
                    @endif
                  </td>
                  <td>{{ $p->name }}</td>
                  <td>{{ \Illuminate\Support\Str::limit($p->description, 50, '...') }}</td>
                  <td class="text-end">Rp {{ number_format($p->price,0,',','.') }}</td>
                  <td class="text-center">{{ $p->stock }}</td>
                  <td class="text-center">
                    <a href="{{ route('products.edit', $p->id) }}"
                       class="btn btn-sm btn-warning me-1">
                      <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>
                    <form action="{{ route('products.destroy', $p->id) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger">
                        <i class="bi bi-trash me-1"></i> Hapus
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-muted">
                    Belum ada produk.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
  </script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js">
  </script>
</body>
</html>
