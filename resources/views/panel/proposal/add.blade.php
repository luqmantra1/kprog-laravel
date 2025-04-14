@extends('panel.layout.app')

@section('content')
<div class="body-wrapper">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h4>Add Proposal</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ url('panel/proposal/insert') }}" enctype="multipart/form-data">
              @csrf

              <!-- Client Selection -->
              <div class="mb-3">
                <label for="client_id" class="form-label">Client</label>
                <select name="client_id" class="form-control" required>
                  <option value="">Select Client</option>
                  @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Proposal Title -->
              <div class="mb-3">
                <label for="proposal_title" class="form-label">Proposal Title</label>
                <select name="proposal_title" class="form-control" required>
                  <option value="">Select Proposal Title</option>
                  <option value="Life Insurance">Life Insurance</option>
                  <option value="Health Insurance">Health Insurance</option>
                  <option value="Motor Insurance">Motor Insurance</option>
                  <option value="Home Insurance">Home Insurance</option>
                  <option value="Travel Insurance">Travel Insurance</option>
                  <option value="Disability Insurance">Disability Insurance</option>
                  <option value="Business Insurance">Business Insurance</option>
                  <option value="Marine Insurance">Marine Insurance</option>
                </select>
              </div>

              <!-- Insurance Type (Optional) -->
              <div class="form-group">
                  <label>Upload Proposal File</label>
                  <input type="file" name="proposal_file" class="form-control">
              </div>

              <!-- Submission Date -->
              <div class="mb-3">
                <label for="submission_date" class="form-label">Submission Date</label>
                <input type="date" name="submission_date" class="form-control" required>
              </div>

              <!-- Status Selection -->
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control" required>
                  <option value="draft">Draft</option>
                  <option value="submitted">Submitted</option>
                  <option value="reviewed">Reviewed</option>
                </select>
              </div>

              <!-- Submit Button -->
              <div class="d-flex justify-content-between align-items-center">
                <a href="{{ url('panel/proposals') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
