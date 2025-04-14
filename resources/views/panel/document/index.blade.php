@extends('panel.layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">📄 Uploaded Documents</h5>
                    <a href="{{ route('document.create') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-upload me-1"></i> Upload New
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Uploaded By</th>
                                    <th>Uploaded At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($documents as $doc)
                                    <tr>
                                        <td><strong>{{ $doc->title }}</strong></td>
                                        <td>{{ $doc->description }}</td>
                                        <td>
                                            <span class="badge bg-info text-dark">
                                                {{ $doc->user->name }}
                                            </span>
                                        </td>
                                        <td>{{ $doc->created_at->format('d M Y, h:i A') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('document.download', $doc->id) }}" class="btn btn-sm btn-success me-1">
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                            <a href="{{ route('document.delete', $doc->id) }}" 
                                               onclick="return confirm('Are you sure you want to delete this document?')"
                                               class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash3"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No documents uploaded yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-muted text-end small">
                    Last updated: {{ now()->format('d M Y, h:i A') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
