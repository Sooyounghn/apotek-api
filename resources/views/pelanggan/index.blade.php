
@extends('layouts.app')

@section('content')

<style>
    .customer-page {
        padding: 10px 5px 30px;
        color: #24352d;
    }

    .customer-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 28px;
        flex-wrap: wrap;
    }

    .customer-title h2 {
        font-size: 27px;
        font-weight: 750;
        margin-bottom: 7px;
        color: #183b2b;
    }

    .customer-title p {
        color: #829087;
        margin: 0;
        font-size: 14px;
    }

    .btn-add-customer {
        background: #198754;
        color: white;
        padding: 12px 19px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: .2s;
    }

    .btn-add-customer:hover {
        background: #146c43;
        color: white;
        transform: translateY(-2px);
    }

    .customer-stat {
        background: white;
        border: 1px solid #e8eee9;
        border-radius: 15px;
        padding: 22px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(20, 60, 35, .04);
    }

    .customer-stat-label {
        color: #829087;
        font-size: 13px;
        margin-bottom: 9px;
    }

    .customer-stat-number {
        color: #198754;
        font-size: 30px;
        font-weight: 750;
    }

    .customer-card {
        background: white;
        border: 1px solid #e8eee9;
        border-radius: 15px;
        box-shadow: 0 4px 18px rgba(20, 60, 35, .04);
        overflow: hidden;
    }

    .customer-card-header {
        padding: 22px 24px;
        border-bottom: 1px solid #edf1ee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .customer-card-header h5 {
        color: #183b2b;
        font-weight: 700;
        margin: 0;
    }

    .customer-search {
        border: 1px solid #dfe8e1;
        border-radius: 9px;
        padding: 10px 13px;
        outline: none;
        width: 250px;
        max-width: 100%;
    }

    .customer-search:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .1);
    }

    .customer-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 750px;
    }

    .customer-table thead {
        background: #f2f8f4;
    }

    .customer-table th {
        color: #557063;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 16px 18px;
        font-weight: 700;
        border-bottom: 1px solid #e8eee9;
    }

    .customer-table td {
        padding: 17px 18px;
        border-bottom: 1px solid #edf1ee;
        font-size: 14px;
        color: #53645a;
        vertical-align: middle;
    }

    .customer-table tbody tr:hover {
        background: #f8fbf9;
    }

    .customer-name {
        font-weight: 650;
        color: #263d30;
    }

    .customer-id {
        color: #829087;
        font-size: 12px;
        margin-top: 4px;
    }

    .customer-actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .customer-actions a,
    .customer-actions button {
        border: none;
        border-radius: 7px;
        padding: 7px 10px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
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

    .customer-empty {
        text-align: center;
        padding: 45px 15px !important;
        color: #829087 !important;
    }

    .customer-alert {
        border-radius: 10px;
        margin-bottom: 20px;
    }

    @media(max-width: 768px) {
        .customer-title h2 {
            font-size: 23px;
        }

        .customer-card-header {
            align-items: stretch;
        }

        .customer-search {
            width: 100%;
        }
    }
</style>

<div class="customer-page">

    {{-- HEADER --}}
    <div class="customer-header">
        <div class="customer-title">
            <h2>Data Pelanggan</h2>
            <p>Kelola dan pantau informasi seluruh pelanggan Apotek+.</p>
        </div>

        <a href="{{ route('pelanggan.create') }}" class="btn-add-customer">
            + Tambah Pelanggan
        </a>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success customer-alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger customer-alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- STATISTIK --}}
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="customer-stat">
                <div class="customer-stat-label">Total Pelanggan Terdaftar</div>
                <div class="customer-stat-number">{{ count($pelanggan) }}</div>
                <small class="text-muted">Jumlah data pelanggan saat ini</small>
            </div>
        </div>
    </div>

    {{-- TABEL DATA --}}
    <div class="customer-card">

        <div class="customer-card-header">
            <div>
                <h5>Daftar Pelanggan</h5>
                <small class="text-muted">Informasi lengkap pelanggan apotek</small>
            </div>

            <input
                type="text"
                id="searchCustomer"
                class="customer-search"
                placeholder="Cari nama atau nomor HP..."
            >
        </div>

        <div class="table-responsive">
            <table class="customer-table" id="customerTable">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pelanggan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <div class="customer-name">
                                    {{ $item['nama'] }}
                                </div>
                                <div class="customer-id">
                                    ID Pelanggan: {{ $item['id_pelanggan'] }}
                                </div>
                            </td>

                            <td>{{ $item['alamat'] }}</td>
                            <td>{{ $item['no_hp'] }}</td>

                            <td>
                                <div class="customer-actions">

                                    <a href="{{ route('pelanggan.show', $item['id_pelanggan']) }}"
                                       class="btn-detail">
                                        Detail
                                    </a>

                                    <a href="{{ route('pelanggan.edit', $item['id_pelanggan']) }}"
                                       class="btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('pelanggan.destroy', $item['id_pelanggan']) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-delete">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="customer-empty">
                                Belum ada data pelanggan yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="p-3 text-muted small">
            Menampilkan {{ count($pelanggan) }} data pelanggan.
        </div>

    </div>

</div>

{{-- FITUR PENCARIAN --}}
<script>
    document.getElementById('searchCustomer').addEventListener('keyup', function () {
        let keyword = this.value.toLowerCase();
        let rows = document.querySelectorAll('#customerTable tbody tr');

        rows.forEach(function (row) {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });
</script>

@endsection
