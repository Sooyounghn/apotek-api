@extends('layouts.app')

@section('title', 'Detail Staf - Apotek+')
@section('page-title', 'Detail Staf')

@section('content')

<div style="padding: 25px 0 45px;">

    <div style="margin-bottom: 30px;">
        <h3 style="color: #354b3c; font-weight: 600;">
            Detail Staf
        </h3>
        <p style="color: #858b83;">
            Informasi lengkap data staf.
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
                <td style="padding: 12px 0; font-weight: 600; width: 30%;">Nama Staf</td>
                <td style="padding: 12px 0;">: {{ $staf->nama }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #edf1eb;">
                <td style="padding: 12px 0; font-weight: 600;">Alamat</td>
                <td style="padding: 12px 0;">: {{ $staf->alamat }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #edf1eb;">
                <td style="padding: 12px 0; font-weight: 600;">Tanggal Lahir</td>
                <td style="padding: 12px 0;">: {{ $staf->tanggal_lahir }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #edf1eb;">
                <td style="padding: 12px 0; font-weight: 600;">Tempat Lahir</td>
                <td style="padding: 12px 0;">: {{ $staf->tempat_lahir }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #edf1eb;">
                <td style="padding: 12px 0; font-weight: 600;">Nomor HP</td>
                <td style="padding: 12px 0;">: {{ $staf->no_hp }}</td>
            </tr>
        </table>

        <div style="margin-top: 30px;">
            <!-- SUDAH DISESUAIKAN PAKAI id_staff DAN URL LANGSUNG -->
            <a href="/staf/{{ $staf->id_staff }}/edit"
                style="background:#718b72; color:white; padding:10px 20px; border-radius:8px; text-decoration:none; display:inline-block;">
                Edit Data
            </a>

            <a href="{{ route('staf.index') }}"
                style="margin-left:15px; color:#718b72; text-decoration:none;">
                Kembali
            </a>
        </div>
    </div>
</div>

@endsection