@extends('layouts.admin')

@section('title', 'Manajemen Guru - Admin Panel')

@section('header_title', 'Guru & Karyawan')
@section('header_subtitle', 'Kelola data tenaga pendidik')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Daftar Guru & Karyawan</h5>
    <a href="{{ route('admin.guru.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus me-2"></i> Tambah Guru
    </a>
</div>

<div class="data-table">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($guru as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if($item->foto && file_exists(public_path('storage/' . $item->foto)))
                        <img src="{{ asset('storage/' . $item->foto) }}" width="40" height="40" style="object-fit: cover; border-radius: 50%;">
                    @else
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-user text-muted"></i>
                        </div>
                    @endif
                </td>
                <td class="fw-semibold">{{ $item->nama }}</td>
                <td>{{ $item->nip ?? '-' }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>
                    <span class="badge bg-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.guru.edit', $item->id) }}" class="btn btn-sm btn-outline-custom">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $item->id }}', '{{ $item->nama }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.guru.destroy', $item->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-4 text-muted">Belum ada data guru</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(id, nama) {
        if (confirm('Apakah Anda yakin ingin menghapus guru "' + nama + '"?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection