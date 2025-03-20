@extends('layouts.app')

@section('title', 'Dokumen yang Tersedia')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dokumen yang Tersedia</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></div>
            <div class="breadcrumb-item active">Dokumen yang Tersedia</div>
        </div>
    </div>

    <div class="section-body">
        @include('partials.alerts')

        @if (session('employee_data_required'))
            <div class="alert alert-warning alert-has-icon">
                <div class="alert-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Perhatian</div>
                    <p>Anda perlu melengkapi data pegawai terlebih dahulu.</p>
                    <a href="{{ route('employees.create') }}" class="btn btn-warning mt-2">
                        <i class="fas fa-user-edit"></i> Lengkapi Data Pegawai
                    </a>
                </div>
            </div>
        @endif

        <div class="row">
            @forelse($templates as $template)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $template->title }}</h4>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">
                                {!! Str::limit($template->description, 100) !!}
                            </p>
                        </div>
                        <div class="card-footer bg-whitesmoke text-center">
                            <a href="{{ route('form-submissions.create-from-template', $template) }}" class="btn btn-primary">
                                <i class="fas fa-file-upload"></i> Isi Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-file"></i>
                                </div>
                                <h2>Tidak ada dokumen yang tersedia</h2>
                                <p class="lead">
                                    Saat ini tidak ada dokumen yang tersedia untuk diisi. Silakan cek kembali nanti.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center">
            {{ $templates->links() }}
        </div>
    </div>
</section>
@endsection 