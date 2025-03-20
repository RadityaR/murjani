@extends('layouts.app')

@section('title', 'Dokumen Saya')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dokumen Saya</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></div>
            <div class="breadcrumb-item active">Dokumen Saya</div>
        </div>
    </div>

    <div class="section-body">
        @include('partials.alerts')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Dokumen yang Disubmit</h4>
                        <div class="card-header-action">
                            <a href="{{ route('form-templates.user-list') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Submit Dokumen Baru
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Jenis Dokumen</th>
                                        <th>Tanggal Submit</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($submissions as $index => $submission)
                                        <tr>
                                            <td>{{ $index + $submissions->firstItem() }}</td>
                                            <td>{{ $submission->formTemplate ? $submission->formTemplate->title : 'N/A' }}</td>
                                            <td>{{ $submission->created_at->format('d M Y, H:i') }}</td>
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
                                            <td colspan="5" class="text-center">Belum ada dokumen yang disubmit</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        {{ $submissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 