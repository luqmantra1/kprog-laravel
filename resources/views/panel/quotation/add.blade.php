@extends('panel.layout.app')

@section('content')
<div class="body-wrapper">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add Quotation</h4>
          </div>
          <div class="card-body">

            <!-- Form Start -->
            <form action="{{ route('quotation.insert') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <!-- Proposal Dropdown -->
              <div class="mb-3">
                <label for="proposal_id" class="form-label">Proposal</label>
                <select name="proposal_id" id="proposal_id" class="form-control" onchange="updateClientInfo()" required>
                  <option value="">Select Proposal</option>
                  @foreach ($getProposal as $proposal)
                    <option value="{{ $proposal->id }}"
                      data-client-id="{{ $proposal->client->id }}"
                      data-client-name="{{ $proposal->client->company_name }}">
                      {{ $proposal->proposal_title }} - {{ $proposal->client->company_name }}
                    </option>
                  @endforeach
                </select>
              </div>

              <!-- Insurance Company -->
              <div class="mb-3">
                <label for="insurance_company" class="form-label">Insurance Company</label>
                <select name="insurance_company" class="form-control" id="insurance_company" required>
                  <option value="">Select</option>
                  <option value="AIA Malaysia">AIA Malaysia</option>
                  <option value="Allianz Malaysia">Allianz Malaysia</option>
                  <option value="Etiqa Insurance & Takaful">Etiqa Insurance & Takaful</option>
                  <option value="Prudential Assurance Malaysia">Prudential Assurance Malaysia</option>
                  <option value="Great Eastern Life Assurance">Great Eastern Life Assurance</option>
                  <option value="Hong Leong Assurance">Hong Leong Assurance</option>
                  <option value="Manulife Insurance">Manulife Insurance</option>
                  <option value="Tokio Marine Life Insurance">Tokio Marine Life Insurance</option>
                  <option value="AXA Affin Life Insurance">AXA Affin Life Insurance</option>
                  <option value="Sun Life Malaysia">Sun Life Malaysia</option>
                  <option value="Zurich Insurance & Takaful">Zurich Insurance & Takaful</option>
                </select>
              </div>

              <!-- Amount -->
              <div class="mb-3">
                <label for="amount" class="form-label">Amount (RM)</label>
                <input type="number" step="0.01" class="form-control" name="amount" required>
              </div>
              
              <!-- Optional Quotation File Upload -->
              <div class="mb-3">
                <label for="quotation_file" class="form-label">Upload Quotation (not more than 2mb.max)</label>
                <input type="file" name="quotation_file" class="form-control" id="quotation_file">
              </div>

              <!-- Status -->
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" name="status" required>
                  <option value="draft">Draft</option>
                  <option value="sent">Sent</option>
                  <option value="under_review">Under Review</option>
                  <option value="approved">Approved</option>
                </select>
              </div>

              <!-- Acceptance Status -->
              <div class="mb-3">
                <label for="acceptance_status" class="form-label">Acceptance Status</label>
                <select class="form-control" name="acceptance_status" required>
                  <option value="awaiting">Awaiting</option>
                  <option value="accepted">Accepted</option>
                  <option value="declined">Declined</option>
                </select>
              </div>

              <!-- Policy Status -->
              <div class="mb-3">
                <label for="policy_status" class="form-label">Policy Status</label>
                <select class="form-control" name="policy_status" required>
                  <option value="not_issued">Not Issued</option>
                  <option value="issued">Issued</option>
                  <option value="cancelled">Cancelled</option>
                </select>
              </div>

              <!-- Action Buttons -->
              <div class="d-flex justify-content-between align-items-center">
                <a href="{{ url('panel/quotations') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </form>
            <!-- Form End -->

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="quotation_number" id="quotation_number">
<input type="hidden" name="client_id" id="client_id">

@endsection

@section('scripts')
<script>
  function generateQuotationNumber() {
    const insuranceCompany = document.getElementById('insurance_company').value;
    const quotationNumberField = document.getElementById('quotation_number');

    let prefix = '';
    switch (insuranceCompany) {
      case 'AIA Malaysia': prefix = 'AIA'; break;
      case 'Zurich Insurance & Takaful': prefix = 'ZCH'; break;
      case 'Allianz Malaysia': prefix = 'ALL'; break;
      case 'Etiqa Insurance & Takaful': prefix = 'ETQ'; break;
      case 'Prudential Assurance Malaysia': prefix = 'PA'; break;
      case 'Great Eastern Life Assurance': prefix = 'GEL'; break;
      case 'Hong Leong Assurance': prefix = 'HL'; break;
      case 'Manulife Insurance': prefix = 'MNL'; break;
      case 'Tokio Marine Life Insurance': prefix = 'TML'; break;
      case 'AXA Affin Life Insurance': prefix = 'AXA'; break;
      case 'Sun Life Malaysia': prefix = 'SLM'; break;
    }

    const randomNumber = Math.floor(Math.random() * 1000000) + 100000;
    quotationNumberField.value = prefix + randomNumber;
  }

  function updateClientInfo() {
    const proposalSelect = document.getElementById('proposal_id');
    const selectedOption = proposalSelect.options[proposalSelect.selectedIndex];
    const clientId = selectedOption.getAttribute('data-client-id');
    
    document.getElementById('client_id').value = clientId;

    // Re-generate quotation number
    generateQuotationNumber();
  }

  // Event: Regenerate quotation number on insurance change
  document.getElementById('insurance_company').addEventListener('change', generateQuotationNumber);

  // Final check on submit
  document.querySelector("form").addEventListener("submit", function(e) {
    const quote = document.getElementById("quotation_number").value;
    const client = document.getElementById("client_id").value;

    if (!quote || !client) {
      e.preventDefault();
      alert("Quotation number or client ID is missing!");
    }
  });
</script>
@endsection
