@extends('layouts.admin')

@section('title', 'Manajemen Galeri - Admin Panel')

@section('header_title', 'Galeri')
@section('header_subtitle', 'Kelola foto kegiatan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Daftar Galeri</h5>
    <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus me-2"></i> Tambah Foto
    </a>
</div>

<div class="row g-4">
    @forelse($galeris as $galeri)
    <div class="col-md-4 col-lg-3">
        <div class="data-table p-2">
            <div class="position-relative">
                <img src="{{ asset('storage/' . $galeri->gambar) }}" class="img-fluid rounded" style="height: 180px; width: 100%; object-fit: cover;">
                <div class="position-absolute top-0 end-0 p-2">
                    <div class="btn-group">
                        <a href="{{ route('admin.galeri.edit', $galeri) }}" class="btn btn-sm btn-light rounded">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-light rounded ms-1" onclick="confirmDelete('{{ $galeri->id }}', '{{ $galeri->judul }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <h6 class="fw-bold mb-1">{{ Str::limit($galeri->judul, 30) }}</h6>
                @if($galeri->deskripsi)
                    <p class="small text-muted mb-0">{{ Str::limit($galeri->deskripsi, 50) }}</p>
                @endif
            </div>
        </div>
        <form id="delete-form-{{ $galeri->id }}" action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
    @empty
    <div class="col-12">
        <div class="data-table p-5 text-center text-muted">
            <i class="fas fa-images fa-3x mb-3"></i>
            <p>Belum ada foto galeri</p>
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary-custom">Upload Foto Pertama</a>
        </div>
    </div>
    @endforelse
</div>

@if(method_exists($galeris, 'links'))
<div class="mt-4">
    {{ $galeris->links() }}
</div>
@endif

<script>
    function confirmDelete(id, judul) {
        if (confirm('Apakah Anda yakin ingin menghapus foto "' + judul + '"?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection