<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk Sepatu - Enamour.id</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    rel="stylesheet">
  <style>
    body { background: #f8f9fa; }
    .card { border-radius: .75rem; box-shadow: 0 .5rem 1rem rgba(0,0,0,.1); }
    .form-control:focus { box-shadow: 0 0 0 .2rem rgba(13,110,253,.25); }
    .img-preview { max-width: 150px; margin-top: .5rem; display: block; }
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header bg-warning text-white">
            <h2 class="h5 mb-0">Edit Produk Sepatu</h2>
          </div>
          <div class="card-body">

            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
              @csrf
              @method('PUT')

              {{-- Nama --}}
              <div class="mb-4">
                <label for="name" class="form-label">Nama Produk</label>
                <input id="name" type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $product->name) }}"
                       required autofocus>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Deskripsi --}}
              <div class="mb-4">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea id="description" name="description"
                          class="form-control @error('description') is-invalid @enderror"
                          rows="4">{{ old('description', $product->description) }}</textarea>
                @error('description')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Harga & Stok --}}
              <div class="row gx-3 mb-4">
                <div class="col-md-6">
                  <label for="price" class="form-label">Harga (Rp)</label>
                  <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input id="price" type="number" name="price"
                           class="form-control @error('price') is-invalid @enderror"
                           value="{{ old('price', $product->price) }}"
                           min="0" step="0.01" required>
                  </div>
                  @error('price')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="stock" class="form-label">Stok</label>
                  <input id="stock" type="number" name="stock"
                         class="form-control @error('stock') is-invalid @enderror"
                         value="{{ old('stock', $product->stock) }}"
                         min="0" required>
                  @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              {{-- Gambar --}}
              <div class="mb-4">
                <label for="image" class="form-label">Gambar Produk</label>
                {{-- Preview gambar lama --}}
                @if($product->image)
                  <img src="{{ asset('storage/'.$product->image) }}"
                       id="imgPreview"
                       class="img-preview"
                       alt="Preview Lama">
                @else
                  <img id="imgPreview" class="img-preview d-none" alt="Preview">
                @endif

                <input id="image" type="file" name="image"
                       class="form-control @error('image') is-invalid @enderror"
                       accept="image/*">
                @error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Tombol --}}
              <div class="d-flex justify-content-end">
                <a href="{{ route('products.index') }}"
                   class="btn btn-outline-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-warning">
                  <i class="bi bi-pencil-square me-1"></i> Perbarui
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Live preview gambar baru --}}
  <script>
    const imgInput = document.getElementById('image');
    const imgTag   = document.getElementById('imgPreview');
    imgInput.addEventListener('change', () => {
      const [file] = imgInput.files;
      if (file) {
        const reader = new FileReader();
        reader.onload = e => {
          imgTag.src = e.target.result;
          imgTag.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
      }
    });
  </script>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
  </script>
</body>
</html>
