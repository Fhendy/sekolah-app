@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan - 404')

@section('content')
<style>
    .error-container {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 2rem;
    }
    .error-code {
        font-size: 6rem;
        font-weight: 800;
        color: #003f87;
        margin-bottom: 1rem;
    }
    .error-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 1rem;
    }
    .error-message {
        color: #64748b;
        margin-bottom: 2rem;
    }
    .btn-home {
        background: #003f87;
        color: white;
        padding: 10px 24px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s;
    }
    .btn-home:hover {
        background: #002a5c;
        color: white;
        transform: translateY(-2px);
    }
</style>

<div class="container">
    <div class="error-container">
        <div>
            <div class="error-code">404</div>
            <h1 class="error-title">Halaman Tidak Ditemukan</h1>
            <p class="error-message">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
            <a href="{{ route('home') }}" class="btn-home">
                <i class="fas fa-home me-2"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection