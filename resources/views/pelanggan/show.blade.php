@extends('layouts.app')

@section('title', 'Detail Pelanggan - Apotek+')
@section('page-title', 'Detail Pelanggan')

@section('content')

<div style="padding: 25px 0 45px;">

    <div style="margin-bottom: 35px;">
        <h4 style="color: #354b3c; font-weight: 600;">
            Detail Pelanggan
        </h4>
        <p style="color: #858b83;">
            Informasi lengkap pelanggan Apotek+.
        </p>
    </div>

    <div style="
        background: white;
        border-radius: 18px;
        padding: 40px;
        border: 1px solid #edf1eb;
        max-width: 750px;
    ">

        <div style="margin-bottom: 25px;">
            <label style="color: #92998f;">ID Pelanggan</label>
            <h5 style="color: #354b3c;">
                {{ $pelanggan['id_pelanggan'] ?? '-' }}
            </h5>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="color: #92998f;">Nama Pelanggan</label>
            <h5 style="color: #354b3c;">
                {{ $pelanggan['nama'] ?? '-' }}
            </h5>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="color: #92998f;">Alamat</label>
            <h5 style="color: #354b3c;">
                {{ $pelanggan['alamat'] ?? '-' }}
            </h5>
        </div>

        <div style="margin-bottom: 30px;">
            <label style="color: #92998f;">Nomor HP</label>
            <h5 style="color: #354b3c;">
                {{ $pelanggan['no_hp'] ?? '-' }}
            </h5>
        </div>

        <a href="{{ route('pelanggan.index') }}"
           style="
               background: #718b72;
               color: white;
               padding: 12px 24px;
               border-radius: 8px;
               text-decoration: none;
           ">
            Kembali
        </a>

    </div>
</div>

@endsection
