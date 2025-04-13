@extends('panel.layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8"> <!-- Adjust width here if needed -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Add New Policy</h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('panel/policy/add') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="quotation_id" class="form-label">Quotation</label>
                            <select name="quotation_id" class="form-control" required>
                                <option value="">-- Select Quotation --</option>
                                @foreach($quotations as $quotation)
                                    <option value="{{ $quotation->id }}">{{ $quotation->quotation_number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="policy_number" class="form-label">Policy Number</label>
                            <input type="text" class="form-control" name="policy_number" value="{{ $autoPolicyNumber }}" readonly>
                        </div>


                        <div class="mb-4">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="expired">Expired</option>
                                <option value="terminated">Terminated</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" required>
                        </div>

                        <div class="mb-4">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Add Policy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
