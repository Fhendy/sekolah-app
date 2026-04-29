@extends('layouts.admin')

@section('title', 'Manajemen Hero Slider - Admin Panel')

@section('header_title', 'Hero Slider')
@section('header_subtitle', 'Kelola slide banner halaman utama')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h5 class="fw-bold mb-0">Daftar Slide Hero</h5>
    <a href="{{ route('admin.hero-slider.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus me-2"></i> Tambah Slide
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="200">Gambar</th>
                        <th>Link</th>
                        <th width="80">Urutan</th>
                        <th width="80">Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($heroSliders as $index => $slider)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($slider->gambar && file_exists(public_path('storage/' . $slider->gambar)))
                                <img src="{{ asset('storage/' . $slider->gambar) }}" width="150" height="60" style="object-fit: cover; border-radius: 8px;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 150px; height: 60px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($slider->link)
                                <a href="{{ $slider->link }}" target="_blank" class="text-truncate" style="max-width: 200px; display: inline-block;">
                                    {{ Str::limit($slider->link, 40) }}
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ $slider->urutan }}</span>
                        </td>
                        <td>
                            <form action="{{ route('admin.hero-slider.status', $slider->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $slider->aktif ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $slider->aktif ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.hero-slider.edit', $slider->id) }}" class="btn btn-sm btn-outline-custom">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $slider->id }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $slider->id }}" action="{{ route('admin.hero-slider.destroy', $slider->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada data hero slider</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus slide ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

<style>
    .btn-primary-custom {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        color: white;
        border: none;
    }
    .btn-primary-custom:hover {
        transform: translateY(-1px);
        color: white;
    }
    .btn-outline-custom {
        border: 1px solid #003f87;
        color: #003f87;
        background: transparent;
    }
    .btn-outline-custom:hover {
        background: #003f87;
        color: white;
    }
</style>
@endsection