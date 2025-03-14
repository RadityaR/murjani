@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Berkas Upload</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengguna</th>
                                    <th>Berkas</th>
                                    <th>Tipe Dokumen</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Tanggal Upload</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($files as $file)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $file->user->name }}</td>
                                    <td>
                                        <a href="{{ route('files.download', $file->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-download"></i> {{ $file->original_name }}
                                        </a>
                                    </td>
                                    <td>{{ $file->document_type_label }}</td>
                                    <td>{{ $file->description }}</td>
                                    <td>
                                        <span class="badge badge-{{ $file->status_badge }}">
                                            {{ $file->status_label }}
                                        </span>
                                        @if($file->validated_at)
                                            <br>
                                            <small class="text-muted">
                                                {{ $file->validated_at->format('d/m/Y H:i') }}
                                                <br>
                                                oleh: {{ $file->validator->name }}
                                            </small>
                                        @endif
                                    </td>
                                    <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($file->status === 'pending')
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#validateModal{{ $file->id }}">
                                                <i class="fas fa-check-circle"></i> Validasi
                                            </button>
                                        @endif
                                        @if($file->validation_notes)
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#notesModal{{ $file->id }}">
                                                <i class="fas fa-eye"></i> Lihat Catatan
                                            </button>
                                        @endif
                                        <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus berkas ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Validation Modal -->
                                <div class="modal fade" id="validateModal{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="validateModalLabel{{ $file->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('files.validate', $file->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="validateModalLabel{{ $file->id }}">Validasi Berkas</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Status Validasi</label>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="validated{{ $file->id }}" name="status" value="validated" class="custom-control-input" required>
                                                            <label class="custom-control-label" for="validated{{ $file->id }}">Terima & Validasi</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="rejected{{ $file->id }}" name="status" value="rejected" class="custom-control-input" required>
                                                            <label class="custom-control-label" for="rejected{{ $file->id }}">Tolak</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="validation_notes">Catatan Validasi</label>
                                                        <textarea class="form-control" id="validation_notes" name="validation_notes" rows="3" required></textarea>
                                                        <small class="form-text text-muted">
                                                            Berikan catatan mengenai hasil validasi berkas ini.
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notes Modal -->
                                @if($file->validation_notes)
                                <div class="modal fade" id="notesModal{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="notesModalLabel{{ $file->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="notesModalLabel{{ $file->id }}">Catatan Validasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $file->validation_notes }}</p>
                                                <hr>
                                                <small class="text-muted">
                                                    Divalidasi pada: {{ $file->validated_at->format('d/m/Y H:i') }}<br>
                                                    Oleh: {{ $file->validator->name }}
                                                </small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 