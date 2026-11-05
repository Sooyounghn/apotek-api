@extends('layouts.app')

@section('title', 'Detail Obat - Apotek+')
@section('page-title', 'Detail Obat')

@section('content')

<div style="padding: 25px 0 45px;">

    <div style="margin-bottom: 30px;">
        <h3 style="color: #354b3c; font-weight: 600;">
            Detail Obat
        </h3>
        <p style="color: #858b83;">
            Informasi lengkap persediaan obat.
        </p>
    </div>

    <div style="
        background: white;
        border-radius: 18px;
        padding: 35px;
        border: 1px solid #edf1eb;
        max-width: 750px;
    ">
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="border-bottom: 1px solid #edf1eb;">
                <td style="padding: 12px 0; font-weight: 600; width: 30%;">Kode Obat</td>
                <td style="padding: 12px 0;">: {{ $obat->kode_obat }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #edf1eb;">
                <td style="padding: 12px 0; font-weight: 600;">Nama Obat</td>
                <td style="padding: 12px 0;">: {{ $obat->nama_obat }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #edf1eb;">
                <td style="padding: 12px 0; font-weight: 600;">Stok Obat</td>
                <td style="padding: 12px 0;">: {{ $obat->stock_obat }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #edf1eb;">
                <td style="padding: 12px 0; font-weight: 600;">Tanggal Kedaluwarsa</td>
                <td style="padding: 12px 0;">: {{ $obat->tanggal_kadaluarsa }}</td>
            </tr>
        </table>

        <div style="margin-top: 30px;">
            <a href="{{ route('obat.edit', $obat->kode_obat) }}"
                style="background:#718b72; color:white; padding:10px 20px; border-radius:8px; text-decoration:none; display:inline-block;">
                Edit Data
            </a>

            <a href="{{ route('obat.index') }}"
                style="margin-left:15px; color:#718b72; text-decoration:none;">
                Kembali
            </a>
        </div>
    </div>
</div>

@endsection