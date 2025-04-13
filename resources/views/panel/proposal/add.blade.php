@extends('panel.layout.app')

@section('content')

<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">

      <h3>Add Proposal</h3>

      <form method="POST" action="{{ url('panel/proposal/insert') }}">
        @csrf

        <div class="mb-3">
          <label>Client</label>
          <select name="client_id" class="form-control" required>
            <option value="">Select Client</option>
            @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->company_name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
            <label>Proposal Title</label>
            <select name="proposal title" class="form-control" required>
                <option value="Select">Select</option>
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

            <div class="mb-3">
            <label>Insurance Type</label>
            
            </div>


        <div class="mb-3">
          <label>Submission Date</label>
          <input type="date" name="submission_date" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Status</label>
          <select name="status" class="form-control" required>
            <option value="draft">Draft</option>
            <option value="submitted">Submitted</option>
            <option value="reviewed">Reviewed</option>
          </select>
        </div>

        <button class="btn btn-success">Submit</button>
      </form>

    </div>
  </div>
</div>

@endsection
