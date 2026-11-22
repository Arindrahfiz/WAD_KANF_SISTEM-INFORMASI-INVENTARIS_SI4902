<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zonasi dan Rak Gudang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <x-sidebar />

    <div class="konten">
        <div class="header">
            <h1>Zonasi dan Rak Gudang</h1>
            <p>Warehouse zoning of goods. Pengelolaan master tata letak gudang, nomor lorong, rak penyimpanan, dan kapasitas fisik.</p>
        </div>

        <div class="isi">

            @if (session('success'))
                <div style="background-color: var(--hijau-muda); color: var(--hijau-tua); border: 1px solid #cbe0d5; padding: 10px 14px; border-radius: 8px; margin-bottom: 16px;">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="error">
                    {{ session('error') }}
                </div>
            @endif

            @if ($data_rak->isEmpty())
                <div class="kosong">
                    <h2>Belum ada data rak</h2>
                    @if (!auth()->check() || in_array(auth()->user()->role, ['admin', 'staff']))
                        <p>Mulai tambahkan tata letak zonasi dan rak penyimpanan untuk mengorganisir inventaris.</p>
                        <a href="{{ route('zonasi.create') }}" class="tombol tombol-utama">+ Tambah Rak Baru</a>
                    @else
                        <p>Saat ini belum ada data tata letak zonasi rak yang tercatat.</p>
                    @endif
                </div>
            @else
                <div style="margin-bottom: 16px; display: flex; justify-content: space-between; align-items: center;">
                    @if (!auth()->check() || in_array(auth()->user()->role, ['admin', 'staff']))
                        <a href="{{ route('zonasi.create') }}" class="tombol tombol-utama">+ Tambah Rak Baru</a>
                    @else
                        <span style="color: var(--teks-abu); font-size: 13px;">Mode Baca (Read-Only)</span>
                    @endif
                </div>

                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Zona</th>
                            <th>Nomor Lorong</th>
                            <th>Kode Rak</th>
                            <th>Kapasitas</th>
                            <th style="width: 170px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_rak as $index => $row)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ str_replace('Zona ', '', $row->zona) }}</td>
                                <td>{{ $row->nomor_lorong }}</td>
                                <td><b>{{ $row->kode_rak }}</b></td>
                                <td>{{ $row->kapasitas }} Kg</td>
                                <td>
                                    @if (!auth()->check() || in_array(auth()->user()->role, ['admin', 'staff']))
                                        <a href="{{ route('zonasi.edit', $row->id) }}" class="tombol tombol-abu tombol-kecil">Edit</a>
                                    @endif

                                    @if (!auth()->check() || auth()->user()->role === 'admin')
                                        <form action="{{ route('zonasi.destroy', $row->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rak ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="tombol tombol-merah tombol-kecil">Delete</button>
                                        </form>
                                    @elseif (auth()->user()->role === 'staff')
                                        <span style="font-size: 11px; color: var(--teks-abu); margin-left: 6px;">Delete Locked</span>
                                    @else
                                        <span style="font-size: 12px; color: var(--teks-abu); font-style: italic;">View Only</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>
