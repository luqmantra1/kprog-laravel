@extends('panel.layout.app')

@section('content')

<!-- Main Wrapper -->
<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">
      <div class="card border-light shadow-sm mb-4">
        <div class="card-header bg-light text-dark d-flex justify-content-between align-items-center">
          <h3 class="mb-0">Edit Role</h3>
        </div>

        <form action="" method="POST">
          @csrf
          <div class="card-body">

            <!-- Role Name Input -->
            <div class="form-group mb-4">
              <label for="inputrole" class="form-label">Role Name</label>
              <input type="text" class="form-control" name="name" value="{{ $getRecord->name }}" required id="inputrole" placeholder="Enter Role Name">
            </div>

            <!-- Permissions Section -->
            <div class="row mb-4">
              <label class="col-sm-12 col-form-label font-weight-bold mb-3">Permissions</label>

              @foreach ($getPermission as $value)
                <div class="col-md-12 mb-3">
                  <h5 class="font-weight-bold text-primary">{{ $value['name'] }}</h5>
                  <div class="row">
                    @foreach ($value['group'] as $group)
                      @php
                        $checked = '';
                      @endphp

                      @foreach ($getRolePermission as $role)
                        @if ($role->permission_id == $group['id'])
                          @php
                            $checked = 'checked';
                            break; // Stop loop after match found
                          @endphp
                        @endif
                      @endforeach

                      <div class="col-md-3 mb-2">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" value="{{ $group['id'] }}" name="permissions_id[]" id="permission-{{ $group['id'] }}" {{ $checked }}>
                          <label class="form-check-label" for="permission-{{ $group['id'] }}">
                            {{ $group['name'] }}
                          </label>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
                <hr>
              @endforeach
            </div>

            <!-- Submit Button -->
            <div class="text-center">
              <button type="submit" class="btn btn-primary btn-lg">Update Role</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
