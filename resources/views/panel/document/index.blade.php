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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Proposal</th>
                                <th>Quotation</th>
                                <th>Policy</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->client->name ?? '-' }}</td>

                                    <!-- Proposal -->
                                    <td>
                                        @if ($item->proposal_path)
                                            <a href="{{ asset('storage/' . $item->proposal_path) }}" class="btn btn-sm btn-outline-primary" target="_blank">Download Proposal</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <!-- Quotation -->
                                    <td>
                                        @if ($item->quotation_path)
                                            <a href="{{ asset('storage/' . $item->quotation_path) }}" class="btn btn-sm btn-outline-success" target="_blank">Download Quotation</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <!-- Policy -->
                                    <td>
                                        @if ($item->policy_path)
                                            <a href="{{ asset('storage/' . $item->policy_path) }}" class="btn btn-sm btn-outline-warning" target="_blank">Download Policy</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-muted">No documents uploaded</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer text-muted text-end small">
                    Last updated: {{ now()->format('d M Y, h:i A') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
