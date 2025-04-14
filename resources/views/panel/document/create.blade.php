@extends('panel.layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-cloud-upload-fill me-2"></i>Upload Document
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-bold">Document Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Company Policy 2024" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Description <small class="text-muted">(optional)</small></label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Write a short description..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Select File <span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control" required>
                            <div class="form-text">
                                Supported formats: <strong>PDF, DOC, DOCX, JPG, PNG</strong>. Max size: <strong>5MB</strong>.
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-upload me-1"></i>Upload Document
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-muted small text-end">
                    Need help? Contact admin for file format issues.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
