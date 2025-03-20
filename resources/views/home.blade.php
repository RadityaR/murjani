@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="section-body">
            @include('partials.alerts')

            @if(!auth()->user()->employee)
            <div class="row">
                <div class="col-12">
                    <div class="card card-large-icons bg-warning text-white">
                        <div class="card-icon bg-warning text-white">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="card-body">
                            <h4 class="text-white">Perhatian!</h4>
                            <p>Anda belum melengkapi data pegawai. Untuk dapat mengakses fitur-fitur lainnya dalam sistem, silakan lengkapi data pegawai Anda.</p>
                            <a href="{{ route('employees.create') }}" class="btn btn-light mt-3">
                                <i class="fas fa-user-edit"></i> Lengkapi Data Pegawai
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(auth()->user()->employee)
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Dokumen Tersedia</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\FormTemplate::where('is_active', true)->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Dokumen Disetujui</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\FormSubmission::where('user_id', auth()->id())->where('status', 'approved')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Dokumen Pending</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\FormSubmission::where('user_id', auth()->id())->where('status', 'pending')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Dokumen Ditolak</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\FormSubmission::where('user_id', auth()->id())->where('status', 'rejected')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Dokumen Tersedia untuk Diisi</h4>
                            <div class="card-header-action">
                                <a href="{{ route('form-templates.user-list') }}" class="btn btn-primary">Lihat Semua</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Jenis Dokumen</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(\App\Models\FormTemplate::where('is_active', true)->latest()->take(5)->get() as $template)
                                        <tr>
                                            <td>{{ $template->title }}</td>
                                            <td>
                                                <a href="{{ route('form-submissions.create-from-template', $template) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-file-upload"></i> Isi Dokumen
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Tidak ada dokumen yang tersedia</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Dokumen Terakhir Disubmit</h4>
                            <div class="card-header-action">
                                <a href="{{ route('form-submissions.user-submissions') }}" class="btn btn-primary">Lihat Semua</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Jenis Dokumen</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(\App\Models\FormSubmission::where('user_id', auth()->id())->with('formTemplate')->latest()->take(5)->get() as $submission)
                                        <tr>
                                            <td>{{ $submission->formTemplate ? $submission->formTemplate->title : 'N/A' }}</td>
                                            <td>
                                                <span class="badge badge-{{ $submission->status == 'approved' ? 'success' : ($submission->status == 'rejected' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($submission->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('form-submissions.show', $submission) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Belum ada dokumen yang disubmit</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pengumuman Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle"></i> Informasi Sistem</h5>
                                <p>Selamat datang di Sistem Informasi Kepegawaian. Sistem ini digunakan untuk mengelola data pegawai dan informasi terkait.</p>
                            </div>
                            
                            <div class="alert alert-warning">
                                <h5><i class="fas fa-exclamation-triangle"></i> Pengumuman Penting</h5>
                                <p>Mohon untuk selalu memperbarui data pegawai Anda secara berkala untuk memastikan informasi yang akurat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    
    <!-- Page Specific JS File -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable for employee table
            $('#employee-table').DataTable({
                "paging": false,
                "ordering": true,
                "info": false,
                "searching": false
            });
        });
    </script>
@endpush
