 @extends('layouts.app')

@section('title', 'Tambah Staf - Apotek+')
@section('page-title', 'Tambah Staf')

@section('content')

<div style="padding: 25px 0 45px;">

    <div style="margin-bottom: 30px;">
        <h3 style="color: #354b3c; font-weight: 600;">
            Tambah Staf
        </h3>
        <p style="color: #858b83;">
            Silakan isi informasi staf baru.
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

        <form action="{{ route('staf.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label>Nama Staf</label>
                <input type="text" name="nama"
                    value="{{ old('nama') }}"
                    placeholder="Masukkan nama staf"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label>Alamat</label>
                <textarea name="alamat"
                    placeholder="Masukkan alamat staf"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">{{ old('alamat') }}</textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir"
                    value="{{ old('tanggal_lahir') }}"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir"
                    value="{{ old('tempat_lahir') }}"
                    placeholder="Masukkan tempat lahir"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">
            </div>

            <div style="margin-bottom: 30px;">
                <label>Nomor HP</label>
                <input type="text" name="no_hp"
                    value="{{ old('no_hp') }}"
                    placeholder="Masukkan nomor HP"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">
            </div>

            <button type="submit"
                style="background:#718b72; color:white; padding:13px 25px; border:none; border-radius:8px; cursor:pointer;">
                Simpan Staf
            </button>

            <a href="{{ route('staf.index') }}"
                style="margin-left:15px; color:#718b72; text-decoration:none;">
                Batal
            </a>

        </form>
    </div>
</div>

@endsection