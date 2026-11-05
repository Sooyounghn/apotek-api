@extends('layouts.app')

@section('title', 'Tambah Pelanggan - Apotek+')
@section('page-title', 'Tambah Pelanggan')

@section('content')

<style>
    .customer-create {
        padding: 15px 5px 40px;
        color: #263d30;
    }

    .create-heading {
        margin-bottom: 25px;
    }

    .create-heading h2 {
        font-size: 26px;
        font-weight: 750;
        color: #183b2b;
        margin-bottom: 8px;
    }

    .create-heading p {
        color: #829087;
        font-size: 14px;
        margin: 0;
    }

    .breadcrumb-text {
        font-size: 13px;
        color: #829087;
        margin-bottom: 20px;
    }

    .breadcrumb-text a {
        color: #198754;
        text-decoration: none;
    }

    .create-card {
        background: white;
        border: 1px solid #e8eee9;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(20, 60, 35, .04);
        max-width: 850px;
        overflow: hidden;
    }

    .create-card-header {
        padding: 23px 28px;
        border-bottom: 1px solid #edf1ee;
        background: #fbfdfb;
    }

    .create-card-header h5 {
        font-weight: 700;
        color: #183b2b;
        margin-bottom: 5px;
    }

    .create-card-header p {
        font-size: 13px;
        color: #829087;
        margin: 0;
    }

    .create-card-body {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 23px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 650;
        color: #354b3c;
        margin-bottom: 9px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 13px 15px;
        border: 1px solid #dfe8e1;
        border-radius: 9px;
        outline: none;
        font-size: 14px;
        color: #354b3c;
        background: white;
        transition: .2s;
        box-sizing: border-box;
    }

    .form-group textarea {
        min-height: 110px;
        resize: vertical;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .10);
    }

    .form-hint {
        color: #929d94;
        font-size: 12px;
        margin-top: 7px;
    }

    .form-error {
        color: #c44545;
        font-size: 12px;
        margin-top: 6px;
    }

    .create-actions {
        display: flex;
        gap: 12px;
        padding-top: 10px;
        flex-wrap: wrap;
    }

    .btn-save {
        background: #198754;
        color: white;
        border: none;
        padding: 12px 23px;
        border-radius: 9px;
        font-weight: 650;
        cursor: pointer;
        transition: .2s;
    }

    .btn-save:hover {
        background: #146c43;
    }

    .btn-cancel {
        background: #f1f5f2;
        color: #53645a;
        padding: 12px 23px;
        border-radius: 9px;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-cancel:hover {
        background: #e5ece7;
        color: #354b3c;
    }

    .alert-create {
        max-width: 850px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    @media(max-width: 600px) {
        .create-card-body {
            padding: 20px;
        }

        .create-heading h2 {
            font-size: 22px;
        }
    }
</style>

<div class="customer-create">

    <div class="breadcrumb-text">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        /
        <a href="{{ route('pelanggan.index') }}">Data Pelanggan</a>
        / Tambah
    </div>

    <div class="create-heading">
        <h2>Tambah Pelanggan</h2>
        <p>Masukkan informasi pelanggan baru ke dalam sistem Apotek+.</p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-create">
            {{ session('error') }}
        </div>
    @endif

    <div class="create-card">

        <div class="create-card-header">
            <h5>Informasi Pelanggan</h5>
            <p>Lengkapi seluruh kolom berikut dengan benar.</p>
        </div>

        <div class="create-card-body">

           <form action="/pelanggan" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Pelanggan</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Andi Saputra"
                        maxlength="255"
                        required
                    >
                    @error('nama')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea
                        id="alamat"
                        name="alamat"
                        placeholder="Masukkan alamat lengkap pelanggan"
                        required
                    >{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor HP</label>
                    <input
                        type="tel"
                        id="no_hp"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        placeholder="Contoh: 081234567890"
                        maxlength="20"
                        required
                    >
                    <div class="form-hint">
                        Masukkan nomor HP yang masih aktif.
                    </div>
                    @error('no_hp')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="create-actions">
                    <button type="submit" class="btn-save">
                        Simpan Pelanggan
                    </button>

                    <a href="{{ route('pelanggan.index') }}" class="btn-cancel">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection