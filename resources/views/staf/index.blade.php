@extends('layouts.app')

@section('content')

<style>
    .staff-page {
        padding: 10px 5px 30px;
        color: #24352d;
    }

    .staff-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 28px;
        flex-wrap: wrap;
    }

    .staff-title h2 {
        font-size: 27px;
        font-weight: 750;
        margin-bottom: 7px;
        color: #183b2b;
    }

    .staff-title p {
        color: #829087;
        margin: 0;
        font-size: 14px;
    }

    .btn-add-staff {
        background: #198754;
        color: white;
        padding: 12px 19px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: .2s;
    }

    .btn-add-staff:hover {
        background: #146c43;
        color: white;
        transform: translateY(-2px);
    }

    .staff-stat {
        background: white;
        border: 1px solid #e8eee9;
        border-radius: 15px;
        padding: 22px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(20, 60, 35, .04);
    }

    .staff-stat-label {
        color: #829087;
        font-size: 13px;
        margin-bottom: 9px;
    }

    .staff-stat-number {
        color: #198754;
        font-size: 30px;
        font-weight: 750;
    }

    .staff-card {
        background: white;
        border: 1px solid #e8eee9;
        border-radius: 15px;
        box-shadow: 0 4px 18px rgba(20, 60, 35, .04);
        overflow: hidden;
    }

    .staff-card-header {
        padding: 22px 24px;
        border-bottom: 1px solid #edf1ee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .staff-card-header h5 {
        color: #183b2b;
        font-weight: 700;
        margin: 0;
    }

    .staff-search {
        border: 1px solid #dfe8e1;
        border-radius: 9px;
        padding: 10px 13px;
        outline: none;
        width: 250px;
        max-width: 100%;
    }

    .staff-search:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .1);
    }

    .staff-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .staff-table thead {
        background: #f2f8f4;
    }

    .staff-table th {
        color: #557063;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 16px 18px;
        font-weight: 700;
        border-bottom: 1px solid #e8eee9;
    }

    .staff-table td {
        padding: 17px 18px;
        border-bottom: 1px solid #edf1ee;
        font-size: 14px;
        color: #53645a;
        vertical-align: middle;
    }

    .staff-table tbody tr:hover {
        background: #f8fbf9;
    }

    .staff-name {
        font-weight: 650;
        color: #263d30;
    }

    .staff-id {
        color: #829087;
        font-size: 12px;
        margin-top: 4px;
    }

    .staff-actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .staff-actions a,
    .staff-actions button {
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

    .staff-empty {
        text-align: center;
        padding: 45px 15px !important;
        color: #829087 !important;
    }

    .staff-alert {
        border-radius: 10px;
        margin-bottom: 20px;
    }

    @media(max-width: 768px) {
        .staff-title h2 {
            font-size: 23px;
        }

        .staff-card-header {
            align-items: stretch;
        }

        .staff-search {
            width: 100%;
        }
    }
</style>

<div class="staff-page">

    {{-- HEADER --}}
    <div class="staff-header">
        <div class="staff-title">
            <h2>Data Staf</h2>
            <p>Kelola dan pantau informasi seluruh staf Apotek+.</p>
        </div>

        <a href="{{ route('staf.create') }}" class="btn-add-staff">
            + Tambah Staf
        </a>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success staff-alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger staff-alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- STATISTIK --}}
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="staff-stat">
                <div class="staff-stat-label">Total Staf Terdaftar</div>
                <div class="staff-stat-number">{{ count($staf) }}</div>
                <small class="text-muted">Jumlah data staf saat ini</small>
            </div>
        </div>
    </div>

    {{-- TABEL DATA --}}
    <div class="staff-card">

        <div class="staff-card-header">
            <div>
                <h5>Daftar Staf</h5>
                <small class="text-muted">Informasi lengkap staf apotek</small>
            </div>

            <input
                type="text"
                id="searchStaff"
                class="staff-search"
                placeholder="Cari nama atau nomor HP..."
            >
        </div>

        <div class="table-responsive">
            <table class="staff-table" id="staffTable">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Staf</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($staf as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <div class="staff-name">
                                    {{ $item->nama }}
                                </div>
                                <div class="staff-id">
                                    ID Staf: {{ $item->id_staff }}
                                </div>
                            </td>

                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->tanggal_lahir }}</td>
                            <td>{{ $item->tempat_lahir }}</td>
                            <td>{{ $item->no_hp }}</td>

                            <td>
                                <div class="staff-actions">

                                    <!-- PARAMETER DIBUAT EKSPLISIT LEWAT OBJECT -->
                                    <a href="/staf/{{ $item->id_staff }}/detail" class="btn-detail">
                                        Detail
                                    </a>

                                    <a href="/staf/{{ $item->id_staff }}/edit" class="btn-edit">
                                        Edit
                                    </a>

                                    <form action="/staf/{{ $item->id_staff }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus staf ini?')">
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
                            <td colspan="7" class="staff-empty">
                                Belum ada data staf yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="p-3 text-muted small">
            Menampilkan {{ count($staf) }} data staf.
        </div>

    </div>

</div>

{{-- FITUR PENCARIAN --}}
<script>
    document.getElementById('searchStaff').addEventListener('keyup', function () {
        let keyword = this.value.toLowerCase();
        let rows = document.querySelectorAll('#staffTable tbody tr');

        rows.forEach(function (row) {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });
</script>

@endsection