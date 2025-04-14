@extends('panel.layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Add New Policy</h3>
                </div>

                <div class="card-body">
                    {{-- Show validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('panel/policy/add') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="quotation_id" class="form-label">Quotation</label>
                            <select name="quotation_id" class="form-control @error('quotation_id') is-invalid @enderror" required>
                                <option value="">-- Select Quotation --</option>
                                @foreach($quotations as $quotation)
                                    <option value="{{ $quotation->id }}" {{ old('quotation_id') == $quotation->id ? 'selected' : '' }}>
                                        {{ $quotation->quotation_number }}
                                    </option>
                                @endforeach
                            </select>
                            @error('quotation_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="policy_number" class="form-label">Policy Number</label>
                            <input type="text" class="form-control" name="policy_number" value="{{ $autoPolicyNumber }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="">-- Select Status --</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                <option value="terminated" {{ old('status') == 'terminated' ? 'selected' : '' }}>Terminated</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" required>
                            @error('end_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
