@extends('layouts.app')

@section('title', 'Atur Harga PPOB')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Atur Harga Produk PPOB</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Daftar Produk</span>
            <a href="{{ route('admin.harga.create') }}" class="btn btn-sm btn-success">+ Tambah Produk</a>
        </div>

        <div class="card-header d-flex justify-content-end">
            <input type="text" id="searchInput" class="form-control w-25" placeholder="Cari produk...">
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle" id="produkTable">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Provider</th>
                        <th>Nama Produk</th>
                        <th>Harga Modal</th>
                        <th>Harga Jual</th>
                        <th>Status</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produkList as $produk)
                    <tr>
                        <td>{{ $produk['kode'] }}</td>
                        <td>{{ $produk['provider'] }}</td>
                        <td>{{ $produk['nama'] }}</td>
                        <td>Rp {{ number_format($produk['harga_modal'], 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($produk['harga_jual'], 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $produk['status'] === 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                {{ $produk['status'] === 'aktif' ? 'Aktif' : 'Non Aktif' }}
                            </span>
                        </td>
                        <td>{{ $produk['kategori'] }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.harga.edit', $produk->id) }}" class="btn btn-sm btn-warning me-1">
                                <i data-feather="edit"></i> Edit
                            </a>
                            <form id="form-hapus-{{ $produk->id }}" action="{{ route('admin.harga.destroy', $produk->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-hapus" data-id="{{ $produk->id }}">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tidak ada produk ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    feather.replace();
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hapusButtons = document.querySelectorAll('.btn-hapus');

        hapusButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data yang dihapus tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-hapus-' + id).submit();
                    }
                });
            });
        });

        // ✨ Fitur Search Filter Client-side
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('produkTable');
        const rows = table.getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function () {
            const query = this.value.toLowerCase();

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    const cellText = cells[j].textContent.toLowerCase();
                    if (cellText.includes(query)) {
                        match = true;
                        break;
                    }
                }

                row.style.display = match ? '' : 'none';
            }
        });
    });
</script>
@endpush
