<form method="POST" action="{{ route('checkout.proses') }}">
    @csrf
    <input type="text" name="nama">
    <textarea name="alamat"></textarea>
    <input type="text" name="no_hp">
    <button type="submit">Pesan</button>
</form>
