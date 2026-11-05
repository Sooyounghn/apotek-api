@extends('layouts.app')

@section('title', 'Edit Pelanggan - Apotek+')
@section('page-title', 'Edit Pelanggan')

@section('content')

<div style="padding: 25px 0 45px;">

    <div style="margin-bottom: 35px;">
        <h4 style="color: #354b3c; font-weight: 600;">
            Edit Pelanggan
        </h4>
        <p style="color: #858b83;">
            Perbarui informasi pelanggan Apotek+.
        </p>
    </div>

    <div style="
        background: white;
        border-radius: 18px;
        padding: 40px;
        border: 1px solid #edf1eb;
        max-width: 750px;
    ">

        @if ($errors->any())
            <div style="color: #a33; margin-bottom: 20px;">
                Periksa kembali data yang kamu masukkan.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pelanggan.update', $pelanggan['id_pelanggan']) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 10px;">
                    Nama Pelanggan
                </label>
                <input type="text"
                       name="nama"
                       value="{{ old('nama', $pelanggan['nama'] ?? '') }}"
                       required
                       style="width: 100%; padding: 13px; border: 1px solid #dce4da; border-radius: 8px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 10px;">
                    Alamat
                </label>
                <textarea name="alamat"
                          required
                          style="width: 100%; padding: 13px; border: 1px solid #dce4da; border-radius: 8px;">{{ old('alamat', $pelanggan['alamat'] ?? '') }}</textarea>
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: block; margin-bottom: 10px;">
                    Nomor HP
                </label>
                <input type="text"
                       name="no_hp"
                       value="{{ old('no_hp', $pelanggan['no_hp'] ?? '') }}"
                       required
                       style="width: 100%; padding: 13px; border: 1px solid #dce4da; border-radius: 8px;">
            </div>

            <button type="submit"
                    style="background: #718b72; color: white; padding: 13px 25px; border: none; border-radius: 8px;">
                Simpan Perubahan
            </button>

            <a href="{{ route('pelanggan.index') }}"
               style="margin-left: 15px; color: #718b72; text-decoration: none;">
                Batal
            </a>

        </form>
    </div>
</div>

@endsection
