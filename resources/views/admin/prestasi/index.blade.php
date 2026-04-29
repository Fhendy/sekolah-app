@extends('layouts.admin')

@section('title', 'Manajemen Prestasi - Admin Panel')

@section('header_title', 'Prestasi')
@section('header_subtitle', 'Kelola data prestasi sekolah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Daftar Prestasi</h5>
    <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus me-2"></i> Tambah Prestasi
    </a>
</div>

<div class="data-table">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tingkat</th>
                <th>Tahun</th>
                <th>Status</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prestasi as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                        <img src="{{ asset('storage/' . $item->gambar) }}" width="50" height="40" style="object-fit: cover; border-radius: 8px;">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 40px;">
                            <i class="fas fa-trophy text-muted"></i>
                        </div>
                    @endif
                </td>
                <td class="fw-semibold">{{ Str::limit($item->judul, 40) }}</td>
                <td>{{ $item->kategori ?? '-' }}</td>
                <td>{{ $item->tingkat ?? '-' }}</td>
                <td>{{ $item->tahun ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.prestasi.edit', $item->id) }}" class="btn btn-sm btn-outline-custom">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $item->id }}', '{{ $item->judul }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.prestasi.destroy', $item->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center py-4 text-muted">Belum ada data prestasi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(id, judul) {
        if (confirm('Apakah Anda yakin ingin menghapus prestasi "' + judul + '"?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection