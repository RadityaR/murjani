@props(['title' => 'Upload Berkas'])

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="document_type">Tipe Dokumen</label>
                <select class="form-control @error('document_type') is-invalid @enderror" id="document_type" name="document_type">
                    <option value="">Pilih Tipe Dokumen</option>
                    <option value="ktp">KTP</option>
                    <option value="ijazah">Ijazah</option>
                    <option value="sertifikat">Sertifikat</option>
                    <option value="surat_keterangan">Surat Keterangan</option>
                    <option value="lainnya">Lainnya</option>
                </select>
                @error('document_type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="document">Pilih Berkas</label>
                <input type="file" class="form-control @error('document') is-invalid @enderror" id="document" name="document" required>
                @error('document')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3"></textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div> 