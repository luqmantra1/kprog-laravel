@extends('panel.layout.app')

@section('content')
<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">
      <div class="card-header border-0">
        <h3 class="mb-0">Edit Quotation</h3>
      </div>

      <form action="{{ url('panel/quotation/edit/' . $quotation->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-3">
    <label for="client_id">Client</label>
    <select name="client_id" class="form-control" required>
        <option value="">-- Select Client --</option>
        @foreach($clients as $client)
            <option value="{{ $client->id }}" {{ $quotation->client_id == $client->id ? 'selected' : '' }}>
                {{ $client->company_name }}
            </option>
        @endforeach
    </select>
</div>



        <div class="mb-3">
          <label class="form-label">Proposal</label>
          <select class="form-control" name="proposal_id" required>
            <option value="">Select</option>
            @foreach($getProposal as $proposal)
              <option value="{{ $proposal->id }}" {{ $quotation->proposal_id == $proposal->id ? 'selected' : '' }}>
                {{ $proposal->proposal_title }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Insurance Company</label>
          <input type="text" class="form-control" name="insurance_company" value="{{ $quotation->insurance_company }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Quotation Number</label>
          <input type="text" class="form-control" name="quotation_number" value="{{ $quotation->quotation_number }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Amount (RM)</label>
          <input type="number" step="0.01" class="form-control" name="amount" value="{{ $quotation->amount }}" required>
        </div>

        <div class="mb-3" style="display: none;">
          <label class="form-label">Replace Quotation File (PDF only)</label>
          <input type="file" class="form-control" name="quotation_file" accept="application/pdf">
          @if($quotation->quotation_file)
            <p class="mt-2">
              <a href="{{ asset('uploads/quotations/' . $quotation->quotation_file) }}" target="_blank">View Current File</a>
            </p>
          @endif
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select class="form-control" name="status" required>
                <option value="draft" {{ $quotation->status == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="sent" {{ $quotation->status == 'sent' ? 'selected' : '' }}>Sent</option>
                <option value="under_review" {{ $quotation->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                <option value="approved" {{ $quotation->status == 'approved' ? 'selected' : '' }}>Approved</option>
            </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Acceptance Status</label>
          <select class="form-control" name="acceptance_status" required>
            <option value="awaiting" {{ $quotation->acceptance_status == 'awaiting' ? 'selected' : '' }}>Awaiting</option>
            <option value="accepted" {{ $quotation->acceptance_status == 'accepted' ? 'selected' : '' }}>Accepted</option>
            <option value="declined" {{ $quotation->acceptance_status == 'declined' ? 'selected' : '' }}>Declined</option>
        </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Policy Status</label>
          <select class="form-control" name="policy_status" required>
            <option value="not_issued" {{ $quotation->policy_status == 'not_issued' ? 'selected' : '' }}>Not Issued</option>
            <option value="issued" {{ $quotation->policy_status == 'issued' ? 'selected' : '' }}>Issued</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
      </form>

    </div>
  </div>
</div>
@endsection
