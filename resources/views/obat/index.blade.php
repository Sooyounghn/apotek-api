@extends('layouts.app')

@section('title', 'Data Obat - Apotek+')
@section('page-title', 'Data Obat')

@section('content')

<style>
    .obat-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        flex-wrap: wrap;
    }

    .obat-actions a,
    .obat-actions button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        border: none;
        border-radius: 7px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-detail {
        background: #e7f2ff;
        color: #2873b9;
    }

    .btn-edit {
        background: #fff4dc;
        color: #a87513;
    }

    .btn-delete {
        background: #ffebeb;
        color: #c44545;
    }

    .obat-table th {
        color: #536553;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .obat-table td {
        color: #687568;
        font-size: 13px;
    }

    .obat-table tbody tr:hover {
        background: #fafcf9;
    }
</style>

<div style="padding: 25px 0 45px;">

    <div style="margin-bottom: 40px;">
        <h4 style="color: #354b3c; font-weight: 600; margin-bottom: 12px;">
            Data Obat
        </h4>
        <p style="color: #858b83; margin: 0; line-height: 1.8;">
            Kelola informasi dan persediaan obat di Apotek+.
        </p>
    </div>

    <div style="background: #ffffff; border-radius: 18px; padding: 35px; border: 1px solid #edf1eb;">

        <div class="d-flex justify-content-between align-items-center flex-wrap"
             style="gap: 20px; margin-bottom: 30px;">

            <div style="flex: 1; min-width: 220px;">
                <h5 style="color: #354b3c; font-weight: 600; margin-bottom: 10px;">
                    Daftar Obat
                </h5>
                <p style="color: #92998f; margin: 0; line-height: 1.7;">
                    Berikut merupakan daftar obat yang tersedia di apotek.
                </p>
            </div>

            <a href="{{ route('obat.create') }}"
               style="display: inline-flex; align-items: center; justify-content: center; white-space: nowrap; background: #718b72; color: white; padding: 13px 22px; border-radius: 9px; text-decoration: none;">
                <i class="bi bi-plus-lg me-2"></i>
                Tambah Obat
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div style="height: 1px; background: #edf1eb; margin-bottom: 25px;"></div>

        <div class="table-responsive">
            <table class="table align-middle mb-0 obat-table">

                <thead>
                    <tr style="background: #f4f7f2;">
                        <th style="padding: 18px;">No.</th>
                        <th style="padding: 18px;">Kode Obat</th>
                        <th style="padding: 18px;">Nama Obat</th>
                        <th style="padding: 18px;">Stok</th>
                        <th style="padding: 18px;">Tanggal Kedaluwarsa</th>
                        <th style="padding: 18px; text-align: center;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($obat as $item)
                        <tr>
                            <td style="padding: 18px;">
                                {{ $loop->iteration }}
                            </td>

                            <td style="padding: 18px;">
                                {{ $item['kode_obat'] ?? '-' }}
                            </td>

                            <td style="padding: 18px;">
                                {{ $item['nama_obat'] ?? '-' }}
                            </td>

                            <td style="padding: 18px;">
                                {{ $item['stock_obat'] ?? 0 }}
                            </td>

                            <td style="padding: 18px;">
                                {{ $item['tanggal_kadaluarsa'] ?? '-' }}
                            </td>

                            <td style="padding: 18px; text-align: center;">
                                <div class="obat-actions">

                                    <a href="{{ route('obat.show', $item['kode_obat']) }}"
                                       class="btn-detail">
                                        <i class="bi bi-eye"></i>
                                        Detail
                                    </a>

                                    <a href="{{ route('obat.edit', $item['kode_obat']) }}"
                                       class="btn-edit">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>

                                    <form action="{{ route('obat.destroy', $item['kode_obat']) }}"
                                          method="POST"
                                          style="display: inline;"
                                          onsubmit="return confirm('Yakin ingin menghapus obat ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-delete">
                                            <i class="bi bi-trash"></i>
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 60px 20px; color: #92998f;">
                                <i class="bi bi-capsule" style="font-size: 35px; display: block; margin-bottom: 18px;"></i>
                                Belum ada data obat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection
