@extends('layouts.admin')

@section('title', 'Manajemen Ekstrakurikuler - Admin Panel')

@section('header_title', 'Ekstrakurikuler')
@section('header_subtitle', 'Kelola kegiatan ekstrakurikuler')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Daftar Ekstrakurikuler</h5>
    <a href="{{ route('admin.eskul.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus me-2"></i> Tambah Eskul
    </a>
</div>

<div class="data-table">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Eskul</th>
                <th>Pembina</th>
                <th>Jadwal</th>
                <th>Status</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($eskuls as $index => $eskul)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if($eskul->gambar && file_exists(public_path('storage/' . $eskul->gambar)))
                        <img src="{{ asset('storage/' . $eskul->gambar) }}" width="50" height="40" style="object-fit: cover; border-radius: 8px;">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 40px;">
                            <i class="fas fa-futbol text-muted"></i>
                        </div>
                    @endif
                </td>
                <td class="fw-semibold">{{ Str::limit($eskul->nama, 40) }}</td>
                <td>{{ $eskul->pembina ?? '-' }}</td>
                <td>{{ $eskul->jadwal ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $eskul->status == 'aktif' ? 'success' : 'secondary' }}">
                        {{ ucfirst($eskul->status) }}
                    </span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.eskul.edit', $eskul->id) }}" class="btn btn-sm btn-outline-custom">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $eskul->id }}', '{{ $eskul->nama }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <form id="delete-form-{{ $eskul->id }}" action="{{ route('admin.eskul.destroy', $eskul->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-4 text-muted">Belum ada data ekstrakurikuler</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($eskuls, 'links'))
<div class="mt-4">
    {{ $eskuls->links() }}
</div>
@endif

<script>
    function confirmDelete(id, nama) {
        if (confirm('Apakah Anda yakin ingin menghapus ekstrakurikuler "' + nama + '"?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection