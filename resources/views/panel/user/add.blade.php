@extends('panel.layout.app')

@section('content')

<!-- Main wrapper -->
<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">
      <div class="card-header border-0 d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New User</h3>
      </div>

      <form action="{{ url('panel/user/add') }}" method="POST">
        @csrf

        <div class="row mb-3">
          <label class="col-sm-12 col-form-label">Name</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" value="{{ old('name')}} " name="name" required>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">Email</label>
          <div class="col-sm-12">
            <input type="email" class="form-control" value="{{ old('email')}} " name="email" required>
            <div style="color:red">{{$errors->first('email')}}</div>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">Password</label>
          <div class="col-sm-12">
            <input type="password" class="form-control" name="password" required>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">Role</label>
          <div class="col-sm-12">
            <select class="form-control" name="role_id" required>
              <option value="">Select</option>
              @foreach($getRole as $value)
                <option {{ (old('role_id') == $value->id) ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>
  </div>
</div>

@endsection
