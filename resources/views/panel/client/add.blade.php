@extends('panel.layout.app')

@section('content')
<div class="body-wrapper">
  <div class="container-fluid">
    <h3>Add Client</h3>
    <form action="{{ url('panel/client/add') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label>Company Name</label>
        <input type="text" name="company_name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Contact Person</label>
        <input type="text" name="contact_person" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
      </div>

      <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control">
      </div>

      <div class="mb-3">
        <label>Address</label>
        <textarea name="address" class="form-control"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</div>
@endsection
