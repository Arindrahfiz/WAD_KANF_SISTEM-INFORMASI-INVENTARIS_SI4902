<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($edit_data) && $edit_data ? 'Edit Data Rak Gudang' : 'Tambah Rak Gudang Baru' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <x-sidebar />

    <div class="konten">
        <div class="header">
            <h1>{{ isset($edit_data) && $edit_data ? 'Edit Data Rak Gudang' : 'Tambah Data Rak Gudang' }}</h1>
            <p>{{ isset($edit_data) && $edit_data ? 'Edit Rack / Zoning Data' : 'Add Rack / Zoning Data' }} &mdash; Isi formulir di bawah ini untuk mengelola tata letak dan kapasitas rak penyimpanan.</p>
        </div>

        <div class="isi">
            <form action="{{ isset($edit_data) && $edit_data ? route('zonasi.update', $edit_data->id) : route('zonasi.store') }}" method="POST" class="form">
                @csrf
                @if (isset($edit_data) && $edit_data)
                    @method('PUT')
                @endif

                @if ($errors->any())
                    <div class="error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <h3>Tata Letak &amp; Kapasitas Rak</h3>

                <div class="kolom">
                    <label for="zona">Zona Gudang</label>
                    <select id="zona" name="zona" required>
                        <option value="">-- Pilih Zona Gudang --</option>
                        <option value="Zona Anoa - A" {{ old('zona', $edit_data->zona ?? '') === 'Zona Anoa - A' ? 'selected' : '' }}>Zona Anoa - A (Dry Storage)</option>
                        <option value="Zona Badak Jawa - B" {{ old('zona', $edit_data->zona ?? '') === 'Zona Badak Jawa - B' ? 'selected' : '' }}>Zona Badak Jawa - B (Chemical material)</option>
                        <option value="Zona Cendrawasih - C" {{ old('zona', $edit_data->zona ?? '') === 'Zona Cendrawasih - C' ? 'selected' : '' }}>Zona Cendrawasih - C (Cold Storage)</option>
                        <option value="Zona Darter - D" {{ old('zona', $edit_data->zona ?? '') === 'Zona Darter - D' ? 'selected' : '' }}>Zona Darter - D (Hot Storage)</option>
                    </select>
                </div>

                <div class="baris">
                    <div class="kolom">
                        <label for="nomor_lorong">Nomor Lorong</label>
                        <input type="text" id="nomor_lorong" name="nomor_lorong" value="{{ old('nomor_lorong', $edit_data->nomor_lorong ?? '') }}" placeholder="Contoh: Corridor 01" required>
                    </div>

                    <div class="kolom">
                        <label for="kode_rak">Kode Rak</label>
                        <input type="text" id="kode_rak" name="kode_rak" value="{{ old('kode_rak', $edit_data->kode_rak ?? '') }}" placeholder="Contoh: A-01" required>
                    </div>
                </div>

                <div class="kolom">
                    <label for="kapasitas">Kapasitas Maksimal (Kg)</label>
                    <input type="number" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $edit_data->kapasitas ?? '') }}" placeholder="Contoh: 150" min="1" required>
                </div>

                <div class="tombol-area">
                    <button type="submit" class="tombol tombol-utama">Simpan Rekaman Rak</button>
                    <a href="{{ route('zonasi.index') }}" class="tombol tombol-abu">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
