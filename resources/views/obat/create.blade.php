 @extends('layouts.app')

@section('title', 'Tambah Obat - Apotek+')
@section('page-title', 'Tambah Obat')

@section('content')

<div style="padding: 25px 0 45px;">

    <div style="margin-bottom: 30px;">
        <h3 style="color: #354b3c; font-weight: 600;">
            Tambah Obat
        </h3>
        <p style="color: #858b83;">
            Silakan isi informasi obat baru.
        </p>
    </div>

    <div style="
        background: white;
        border-radius: 18px;
        padding: 35px;
        border: 1px solid #edf1eb;
        max-width: 750px;
    ">

        @if ($errors->any())
            <div style="color: #a33; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <p style="color: #a33;">
                {{ session('error') }}
            </p>
        @endif

        <form action="{{ route('obat.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label>Nama Obat</label>
                <input type="text" name="nama_obat"
                    value="{{ old('nama_obat') }}"
                    placeholder="Masukkan nama obat"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label>Stok Obat</label>
                <input type="number" name="stock_obat"
                    value="{{ old('stock_obat') }}"
                    placeholder="Masukkan jumlah stok"
                    min="0"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">
            </div>

            <div style="margin-bottom: 30px;">
                <label>Tanggal Kedaluwarsa</label>
                <input type="date" name="tanggal_kadaluarsa"
                    value="{{ old('tanggal_kadaluarsa') }}"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">
            </div>

            <button type="submit"
                style="background:#718b72; color:white; padding:13px 25px; border:none; border-radius:8px; cursor:pointer;">
                Simpan Obat
            </button>

            <a href="{{ route('obat.index') }}"
                style="margin-left:15px; color:#718b72; text-decoration:none;">
                Batal
            </a>

        </form>
    </div>
</div>

@endsection