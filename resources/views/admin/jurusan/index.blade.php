@extends('layouts.admin')

@section('title', 'Manajemen Jurusan - Admin Panel')

@section('header_title', 'Jurusan')
@section('header_subtitle', 'Kelola data program keahlian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Daftar Jurusan</h5>
    <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus me-2"></i> Tambah Jurusan
    </a>
</div>

<div class="data-table">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Logo</th>
                <th>Kode</th>
                <th>Nama Jurusan</th>
                <th>Ikon</th>
                <th>Brosur</th>
                <th width="140">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jurusans as $index => $jurusan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if($jurusan->logo && file_exists(public_path('storage/' . $jurusan->logo)))
                        <img src="{{ asset('storage/' . $jurusan->logo) }}" width="40" height="40" style="object-fit: cover; border-radius: 8px;">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-image text-muted"></i>
                        </div>
                    @endif
                </td>
                <td><span class="badge bg-primary">{{ $jurusan->kode }}</span></td>
                <td class="fw-semibold">{{ $jurusan->nama }}</td>
                <td><i class="fas {{ $jurusan->ikon ?? 'fa-laptop-code' }}"></i></td>
                <td>
                    @if($jurusan->brosur && file_exists(public_path('storage/' . $jurusan->brosur)))
                        <a href="{{ asset('storage/' . $jurusan->brosur) }}" target="_blank" class="btn btn-sm btn-outline-custom">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.jurusan.edit', $jurusan->id) }}" class="btn btn-sm btn-outline-custom">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $jurusan->id }}', '{{ $jurusan->nama }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <form id="delete-form-{{ $jurusan->id }}" action="{{ route('admin.jurusan.destroy', $jurusan->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-4 text-muted">Belum ada data jurusan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($jurusans, 'links'))
<div class="mt-4">
    {{ $jurusans->links() }}
</div>
@endif

<script>
    function confirmDelete(id, nama) {
        if (confirm('Apakah Anda yakin ingin menghapus jurusan "' + nama + '"?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection