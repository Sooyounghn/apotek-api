@extends('layouts.app')

@section('title', 'Edit Staf - Apotek+')
@section('page-title', 'Edit Staf')

@section('content')

<div style="padding: 25px 0 45px;">

    <div style="margin-bottom: 30px;">
        <h3 style="color: #354b3c; font-weight: 600;">
            Edit Staf
        </h3>
        <p style="color: #858b83;">
            Perbarui informasi data staf.
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
            <p style="color: #a33; margin-bottom: 20px;">
                {{ session('error') }}
            </p>
        @endif

        <!-- ACTION FORM DIPERBAIKI MENGGUNAKAN id_staff -->
        <form action="/staf/{{ $staf->id_staff }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 20px;">
                <label>Nama Staf</label>
                <input type="text" name="nama"
                    value="{{ old('nama', $staf->nama) }}"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label>Alamat</label>
                <textarea name="alamat"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">{{ old('alamat', $staf->alamat) }}</textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir"
                    value="{{ old('tanggal_lahir', $staf->tanggal_lahir) }}"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir"
                    value="{{ old('tempat_lahir', $staf->tempat_lahir) }}"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">
            </div>

            <div style="margin-bottom: 30px;">
                <label>Nomor HP</label>
                <input type="text" name="no_hp"
                    value="{{ old('no_hp', $staf->no_hp) }}"
                    required
                    style="display:block; width:100%; padding:13px; margin-top:8px; border:1px solid #dce4da; border-radius:8px;">
            </div>

            <button type="submit"
                style="background:#718b72; color:white; padding:13px 25px; border:none; border-radius:8px; cursor:pointer;">
                Update Staf
            </button>

            <a href="{{ route('staf.index') }}"
                style="margin-left:15px; color:#718b72; text-decoration:none;">
                Batal
            </a>

        </form>
    </div>
</div>

@endsection