@extends('panel.layout.app')

@section('content')
<div class="body-wrapper">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header bg-success text-white">
            <h4>Edit Client</h4>
          </div>
          <div class="card-body">
            <form action="{{ url('panel/client/edit/'.$getRecord->id) }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" name="company_name" value="{{ $getRecord->company_name }}" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="contact_person" class="form-label">Contact Person</label>
                <input type="text" name="contact_person" value="{{ $getRecord->contact_person }}" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ $getRecord->email }}" class="form-control">
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ $getRecord->phone }}" class="form-control">
              </div>

              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="4">{{ $getRecord->address }}</textarea>
              </div>

              <div class="d-flex justify-content-between align-items-center">
                <a href="{{ url('panel/client') }}" class="btn btn-secondary">Cancel</a>
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
