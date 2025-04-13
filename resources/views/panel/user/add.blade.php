@extends('panel.layout.app')

@section('content')

<!-- Main Wrapper -->
<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">
      <div class="card border-light shadow-sm mb-4">
        <div class="card-header bg-light text-dark d-flex justify-content-between align-items-center">
          <h3 class="mb-0">Add New User</h3>
        </div>

        <form action="{{ url('panel/user/add') }}" method="POST">
          @csrf
          <div class="card-body">

            <!-- Name Input -->
            <div class="form-group mb-4">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}" required id="name" placeholder="Enter full name">
            </div>

            <!-- Email Input -->
            <div class="form-group mb-4">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" name="email" value="{{ old('email') }}" required id="email" placeholder="Enter email">
              <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
            </div>

            <!-- Password Input -->
            <div class="form-group mb-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" required id="password" placeholder="Enter password">
            </div>

            <!-- Role Selection -->
            <div class="form-group mb-4">
              <label for="role_id" class="form-label">Assign Role</label>
              <select class="form-control" name="role_id" required id="role_id">
                <option value="">Select Role</option>
                @foreach($getRole as $value)
                  <option {{ (old('role_id') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
              <button type="submit" class="btn btn-primary btn-lg">Add User</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
