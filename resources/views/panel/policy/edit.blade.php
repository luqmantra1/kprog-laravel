@extends('panel.layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h3 class="mb-0">Edit Policy</h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('panel/policy/edit/'.$getRecord->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="quotation_id" class="form-label">Quotation</label>
                            <select name="quotation_id" class="form-control" required>
                                <option value="">-- Select Quotation --</option>
                                @foreach($quotations as $quotation)
                                    <option value="{{ $quotation->id }}" {{ $quotation->id == $getRecord->quotation_id ? 'selected' : '' }}>
                                        {{ $quotation->quotation_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="policy_number" class="form-label">Policy Number</label>
                            <input type="text" class="form-control" name="policy_number" value="{{ $getRecord->policy_number }}" required placeholder="Enter policy number" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active" {{ $getRecord->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="expired" {{ $getRecord->status == 'expired' ? 'selected' : '' }}>Expired</option>
                                <option value="terminated" {{ $getRecord->status == 'terminated' ? 'selected' : '' }}>Terminated</option>
                                <option value="cancelled" {{ $getRecord->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" value="{{ $getRecord->start_date }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" value="{{ $getRecord->end_date }}" required>
                        </div>

                        <!-- Display Existing Policy File -->
                        @if(!empty($getRecord->policy_file))
                            <div class="mb-4">
                                <label class="form-label">Current Policy File : </label>
                                <a href="{{ asset('public/storage/' . $getRecord->policy_file) }}" target="_blank" class="btn btn-info">View Current File</a>
                                <small class="d-block mt-2">If you wish to update the file, upload a new one below.</small>
                            </div>
                        @endif

                        <!-- Policy File Upload -->
                        <div class="mb-4">
                            <label for="policy_file" class="form-label">Upload New Policy File (Optional)</label>
                            <input type="file" class="form-control" name="policy_file" accept="application/pdf">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning text-white">Update Policy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
