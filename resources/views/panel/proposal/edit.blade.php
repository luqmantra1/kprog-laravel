@extends('panel.layout.app')

@section('content')
<div class="body-wrapper">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h4>Edit Proposal</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ url('panel/proposal/update/'.$getRecord->id) }}" enctype="multipart/form-data">
              @csrf

              <!-- Client Selection -->
              <div class="mb-3">
                <label for="client_id" class="form-label">Client</label>
                <select name="client_id" class="form-control" required>
                  <option value="">Select Client</option>
                  @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $getRecord->client_id == $client->id ? 'selected' : '' }}>
                      {{ $client->company_name }}
                    </option>
                  @endforeach
                </select>
              </div>

              <!-- Proposal Title -->
              <div class="mb-3">
                <label for="proposal_title" class="form-label">Proposal Title</label>
                <select name="proposal_title" class="form-control" required>
                  <option value="Select" {{ $getRecord->proposal_title == 'Select' ? 'selected' : '' }}>Select</option>
                  <option value="Life Insurance" {{ $getRecord->proposal_title == 'Life Insurance' ? 'selected' : '' }}>Life Insurance</option>
                  <option value="Health Insurance" {{ $getRecord->proposal_title == 'Health Insurance' ? 'selected' : '' }}>Health Insurance</option>
                  <option value="Motor Insurance" {{ $getRecord->proposal_title == 'Motor Insurance' ? 'selected' : '' }}>Motor Insurance</option>
                  <option value="Home Insurance" {{ $getRecord->proposal_title == 'Home Insurance' ? 'selected' : '' }}>Home Insurance</option>
                  <option value="Travel Insurance" {{ $getRecord->proposal_title == 'Travel Insurance' ? 'selected' : '' }}>Travel Insurance</option>
                  <option value="Disability Insurance" {{ $getRecord->proposal_title == 'Disability Insurance' ? 'selected' : '' }}>Disability Insurance</option>
                  <option value="Business Insurance" {{ $getRecord->proposal_title == 'Business Insurance' ? 'selected' : '' }}>Business Insurance</option>
                  <option value="Marine Insurance" {{ $getRecord->proposal_title == 'Marine Insurance' ? 'selected' : '' }}>Marine Insurance</option>
                </select>
              </div>

              <!-- Submission Date -->
              <div class="mb-3">
                <label for="submission_date" class="form-label">Submission Date</label>
                <input type="date" name="submission_date" class="form-control" value="{{ $getRecord->submission_date }}" required>
              </div>

              <!-- Status -->
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control" required>
                  <option value="draft" {{ $getRecord->status == 'draft' ? 'selected' : '' }}>Draft</option>
                  <option value="submitted" {{ $getRecord->status == 'submitted' ? 'selected' : '' }}>Submitted</option>
                  <option value="reviewed" {{ $getRecord->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                </select>
              </div>

              <!-- File Upload (Optional) -->
              <div class="mb-3">
                <label for="proposal_file" class="form-label">Proposal File (PDF)</label>
                <input type="file" name="proposal_file" class="form-control" accept="application/pdf">
                
                @if($getRecord->proposal_file)
                  <small class="mt-2 d-block">Current File: <a href="{{ asset('public/storage/' . $getRecord->proposal_file) }}" target="_blank">{{ basename($getRecord->proposal_file) }}</a></small>
                @endif
              </div>

              <!-- Action Buttons -->
              <div class="d-flex justify-content-between align-items-center">
                <a href="{{ url('panel/proposal') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
