@extends('layouts.admin')

@section('title', 'Manajemen Pendaftaran - Admin Panel')

@section('header_title', 'Pendaftaran Siswa Baru')
@section('header_subtitle', 'Kelola data pendaftaran PPDB')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h5 class="fw-bold mb-0">Daftar Pendaftaran</h5>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-danger" id="deleteSelectedBtn" style="display: none;">
            <i class="fas fa-trash-alt me-2"></i> Hapus Terpilih
        </button>
    </div>
</div>

<!-- Form Pencarian -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.pendaftaran.index') }}" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Cari nama, kode, atau jurusan..." 
                           value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" name="date_from" class="form-control" placeholder="Dari tanggal" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary-custom w-100">
                    <i class="fas fa-search me-2"></i> Cari
                </button>
            </div>
        </form>
    </div>
</div>

<div class="data-table">
   <form id="bulkDeleteForm" action="{{ route('admin.pendaftaran.bulk-delete') }}" method="POST">
    @csrf
    <!-- TIDAK ADA @method('DELETE') -->
    <input type="hidden" name="ids" id="bulkDeleteIds" value="">
    
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th width="40">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                    </div>
                </th>
                <th>No</th>
                <th>Kode Pendaftaran</th>
                <th>Nama Lengkap</th>
                <th>Jurusan</th>
                <th>No. WA Siswa</th>
                <th>Tanggal Daftar</th>
                <th>Status</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftarans as $index => $item)
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input pendaftaran-checkbox" type="checkbox" name="ids[]" value="{{ $item->id }}">
                    </div>
                </td>
                <td>{{ $index + 1 }}</div>
                <td><strong>{{ $item->kode_pendaftaran }}</strong></div>
                <td>{{ $item->nama_lengkap }}</div>
                <td>{{ $item->jurusan }}</div>
                <td>{{ $item->no_wa_siswa }}</div>
                <td>{{ $item->created_at->format('d M Y H:i') }}</div>
                <td>
                    <form action="{{ route('admin.pendaftaran.update-status', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="width: 110px;">
                            <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="verified" {{ $item->status == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="rejected" {{ $item->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </form>
                </div>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.pendaftaran.detail', $item->id) }}" class="btn btn-sm btn-outline-custom">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $item->id }}', '{{ $item->nama_lengkap }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.pendaftaran.destroy', $item->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center py-4 text-muted">Belum ada data pendaftaran</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</form>
</div>

@if(isset($pendaftarans) && method_exists($pendaftarans, 'links'))
<div class="mt-4">
    {{ $pendaftarans->appends(request()->query())->links() }}
</div>
@endif

<script>
    const selectAllCheckbox = document.getElementById('selectAll');
    const pendaftaranCheckboxes = document.querySelectorAll('.pendaftaran-checkbox');
    const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
    const bulkDeleteForm = document.getElementById('bulkDeleteForm');
    
    function toggleDeleteButton() {
        const anyChecked = Array.from(pendaftaranCheckboxes).some(cb => cb.checked);
        if (deleteSelectedBtn) {
            deleteSelectedBtn.style.display = anyChecked ? 'inline-block' : 'none';
        }
    }
    
    // Select All
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            pendaftaranCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            toggleDeleteButton();
        });
    }
    
    // Individual checkbox
    pendaftaranCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(pendaftaranCheckboxes).every(cb => cb.checked);
            const someChecked = Array.from(pendaftaranCheckboxes).some(cb => cb.checked);
            
            if (selectAllCheckbox) {
                if (allChecked) {
                    selectAllCheckbox.checked = true;
                    selectAllCheckbox.indeterminate = false;
                } else if (someChecked) {
                    selectAllCheckbox.indeterminate = true;
                    selectAllCheckbox.checked = false;
                } else {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                }
            }
            toggleDeleteButton();
        });
    });
    
    // Bulk Delete - Submit form langsung
    if (deleteSelectedBtn) {
        deleteSelectedBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const checkedIds = Array.from(pendaftaranCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);
            
            if (checkedIds.length === 0) {
                alert('Pilih minimal satu pendaftaran untuk dihapus.');
                return;
            }
            
            if (confirm('Apakah Anda yakin ingin menghapus ' + checkedIds.length + ' data pendaftaran yang dipilih?')) {
                // Submit form biasa - karena name="ids[]" sudah ada
                bulkDeleteForm.submit();
            }
        });
    }
    
    function confirmDelete(id, nama) {
        if (confirm('Apakah Anda yakin ingin menghapus pendaftaran "' + nama + '"?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

<style>
    .btn-primary-custom {
        background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        color: white;
        border: none;
        transition: all 0.2s;
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px -5px rgba(0, 63, 135, 0.3);
        color: white;
    }
    
    .btn-outline-custom {
        border: 1px solid #003f87;
        color: #003f87;
        background: transparent;
        transition: all 0.2s;
    }
    
    .btn-outline-custom:hover {
        background: #003f87;
        color: white;
    }
    
    .btn-danger {
        background: #dc2626;
        border: none;
    }
    
    .btn-danger:hover {
        background: #b91c1c;
    }
    
    .form-check-input:checked {
        background-color: #003f87;
        border-color: #003f87;
    }
    
    .input-group-text {
        border-color: #cbd5e1;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #003f87;
        box-shadow: 0 0 0 3px rgba(0, 63, 135, 0.1);
    }
</style>
@endsection