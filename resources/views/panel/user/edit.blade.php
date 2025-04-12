@extends('panel.layout.app')

@section('content')

<!-- Main wrapper -->
<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">
      <div class="card-header border-0 d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit User</h3>
      </div>

      <form action="" method="POST">
        @csrf

        <div class="row mb-3">
          <label class="col-sm-12 col-form-label">Name</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" value="{{ $getRecord->name }} " name="name" required>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">Email</label>
          <div class="col-sm-12">
            <input type="email" class="form-control" value="{{ $getRecord->email}} " name="email" required>
            <div style="color:red">{{$errors->first('email')}}</div>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">Password</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" name="password">
            (Do you want to change password ? Please add. Otherwise Leave It)
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">Role</label>
          <div class="col-sm-12">
            <select class="form-control" name="role_id" required>
              <option value="">Select</option>
              @foreach($getRole as $value)
                <option {{ ($getRecord->role_id == $value->id) ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
      </form>

    </div>
  </div>
</div>

@endsection
