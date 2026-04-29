@extends('layouts.admin')

@section('title', 'Manajemen Berita - Admin Panel')

@section('header_title', 'Berita')
@section('header_subtitle', 'Kelola artikel berita')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Daftar Berita</h5>
    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus me-2"></i> Tambah Berita
    </a>
</div>

<div class="data-table">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tanggal</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($beritas as $index => $berita)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" width="50" height="40" style="object-fit: cover; border-radius: 8px;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 40px; display: none;">
                            <i class="fas fa-image text-muted"></i>
                        </div>
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 40px;">
                            <i class="fas fa-image text-muted"></i>
                        </div>
                    @endif
                </td>
                <td class="fw-semibold">{{ Str::limit($berita->judul, 50) }}</td>
                <td>{{ $berita->penulis }}</td>
                <td>{{ $berita->tanggal->format('d M Y') }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-sm btn-outline-custom">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $berita->id }}', '{{ $berita->judul }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <form id="delete-form-{{ $berita->id }}" action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-muted">Belum ada berita</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($beritas, 'links'))
<div class="mt-4">
    {{ $beritas->links() }}
</div>
@endif

<script>
    function confirmDelete(id, judul) {
        if (confirm('Apakah Anda yakin ingin menghapus berita "' + judul + '"?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection