<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk Sepatu - Enamour.id</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8f9fa; }
    .card { border-radius: .75rem; box-shadow: 0 .5rem 1rem rgba(0,0,0,.1); }
    .form-control:focus { box-shadow: 0 0 0 .2rem rgba(13,110,253,.25); }
    .img-preview { max-width: 150px; margin-top: .5rem; }
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h2 class="h5 mb-0">Tambah Produk Sepatu</h2>
          </div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('products.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate>
              @csrf

              <div class="mb-4">
                <label for="name" class="form-label">Nama Produk</label>
                <input id="name" type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="Contoh: Sneakers Pria Slip-On"
                       autofocus required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-4">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea id="description" name="description"
                          class="form-control @error('description') is-invalid @enderror"
                          rows="4"
                          placeholder="Tuliskan detail produk...">{{ old('description') }}</textarea>
                @error('description')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="row gx-3 mb-4">
                <div class="col-md-6">
                  <label for="price" class="form-label">Harga (Rp)</label>
                  <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input id="price" type="number" name="price"
                           class="form-control @error('price') is-invalid @enderror"
                           value="{{ old('price') }}" min="0" step="0.01"
                           placeholder="249000" required>
                  </div>
                  @error('price')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                  <small class="text-muted">Preview: <span id="previewHarga">Rp 0</span></small>
                </div>

                <div class="col-md-6">
                  <label for="stock" class="form-label">Stok</label>
                  <input id="stock" type="number" name="stock"
                         class="form-control @error('stock') is-invalid @enderror"
                         value="{{ old('stock') }}" min="0"
                         placeholder="10" required>
                  @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="mb-4">
                <label for="image" class="form-label">Gambar Produk</label>
                <input id="image" type="file" name="image"
                       class="form-control @error('image') is-invalid @enderror"
                       accept="image/*">
                @error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <img id="imgPreview" src="#" class="img-preview d-none" alt="preview">
              </div>

              <div class="d-flex justify-content-end">
                <a href="{{ route('products.index') }}"
                   class="btn btn-outline-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">
                  <i class="bi bi-save me-1"></i> Simpan
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Preview Harga Otomatis
    const priceInput = document.getElementById('price');
    const previewEl  = document.getElementById('previewHarga');
    priceInput.addEventListener('input', () => {
      const val = parseFloat(priceInput.value) || 0;
      previewEl.textContent = 'Rp ' + val.toLocaleString('id-ID', {minimumFractionDigits: 0});
    });

    // Preview Gambar Sebelum Upload
    document.getElementById('image').addEventListener('change', function(){
      const [file] = this.files;
      if (file) {
        const reader = new FileReader();
        reader.onload = e => {
          const img = document.getElementById('imgPreview');
          img.src = e.target.result;
          img.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
</body>
</html>
