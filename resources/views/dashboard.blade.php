```php
@extends('layouts.app')

@section('title', 'Dashboard - Apotek')
@section('page-title', 'Dashboard')

@section('content')

<style>
    .welcome {
        margin-bottom: 30px;
    }

    .welcome h3 {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #354b39;
    }

    .welcome p {
        color: #879187;
        font-size: 14px;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #edf0e9;
        border-radius: 12px;
        padding: 24px;
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #e8f0e5;
        color: #648368;
        font-size: 19px;
    }

    .stat-card h4 {
        font-size: 13px;
        color: #849084;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .stat-card h2 {
        font-size: 27px;
        color: #354b39;
        font-weight: 600;
    }

    .section-title {
        font-size: 17px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #354b39;
    }

    .info-panel {
        background: #fff;
        border: 1px solid #edf0e9;
        border-radius: 12px;
        padding: 25px;
    }

    .info-panel p {
        font-size: 14px;
        color: #788478;
        line-height: 1.8;
    }

    @media (max-width: 900px) {
        .stats {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="welcome">
    <h3>Selamat Datang di Apotek+</h3>
    <p>Kelola data apotek dengan lebih mudah dan teratur.</p>
</div>

<div class="stats">

    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>
        </div>

        <h4>Total Pelanggan</h4>
        <h2>{{ $totalPelanggan ?? 0 }}</h2>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon">
                <i class="bi bi-person-badge"></i>
            </div>
        </div>

        <h4>Total Staf</h4>
        <h2>{{ $totalStaf ?? 0 }}</h2>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon">
                <i class="bi bi-capsule"></i>
            </div>
        </div>

        <h4>Total Jenis Obat</h4>
        <h2>{{ $totalObat ?? 0 }}</h2>
    </div>

</div>

<h3 class="section-title">Informasi Aplikasi</h3>

<div class="info-panel">
    <p>
        Apotek+ merupakan aplikasi pengelolaan data apotek
        yang digunakan untuk membantu mengatur informasi
        pelanggan, staf, dan persediaan obat.
    </p>
</div>

@endsection
```