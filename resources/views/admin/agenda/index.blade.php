@extends('layouts.admin')

@section('title', 'Manajemen Agenda - Admin Panel')

@section('header_title', 'Agenda')
@section('header_subtitle', 'Kelola jadwal kegiatan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Daftar Agenda</h5>
    <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus me-2"></i> Tambah Agenda
    </a>
</div>

<div class="data-table">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal & Waktu</th>
                <th>Tempat</th>
                <th>Tipe</th>
                <th>Status</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agendas as $index => $agenda)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="fw-semibold">{{ Str::limit($agenda->judul, 50) }}</td>
                <td>
                    {{ $agenda->tanggal_mulai->format('d M Y H:i') }}<br>
                    <small class="text-muted">s/d {{ $agenda->tanggal_selesai->format('d M Y H:i') }}</small>
                </td>
                <td>{{ $agenda->tempat }}</td>
                <td>
                    <span class="badge bg-info">{{ $agenda->tipe ?? 'Umum' }}</span>
                </td>
                <td>
                    <span class="badge bg-{{ $agenda->status == 'Akan Datang' ? 'success' : ($agenda->status == 'Berlangsung' ? 'warning' : 'secondary') }}">
                        {{ $agenda->status }}
                    </span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="btn btn-sm btn-outline-custom">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $agenda->id }}', '{{ $agenda->judul }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <form id="delete-form-{{ $agenda->id }}" action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-4 text-muted">Belum ada agenda</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($agendas, 'links'))
<div class="mt-4">
    {{ $agendas->links() }}
</div>
@endif

<script>
    function confirmDelete(id, judul) {
        if (confirm('Apakah Anda yakin ingin menghapus agenda "' + judul + '"?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection