@extends('panel.layout.app')

@section('content')
<div class="body-wrapper">
  <div class="container-fluid">
    <h3>Edit Client</h3>
    <form action="{{ url('panel/client/edit/'.$getRecord->id) }}" method="POST">
      @csrf

      <div class="mb-3">
        <label>Company Name</label>
        <input type="text" name="company_name" value="{{ $getRecord->company_name }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Contact Person</label>
        <input type="text" name="contact_person" value="{{ $getRecord->contact_person }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $getRecord->email }}" class="form-control">
      </div>

      <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" value="{{ $getRecord->phone }}" class="form-control">
      </div>

      <div class="mb-3">
        <label>Address</label>
        <textarea name="address" class="form-control">{{ $getRecord->address }}</textarea>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
@endsection
