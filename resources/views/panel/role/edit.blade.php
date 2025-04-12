@extends('panel.layout.app')

@section('content')

<div class="body-wrapper">
  <div class="body-wrapper-inner">
    <div class="container-fluid">
      <div class="card-header border-0 d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Role</h3>
      </div>

      <form action="" method="post">
        @csrf
        <div class="row mb-3">
            <label for="inputText" class="col-sm-12 col-form-label">Name</label>
            <div class="col-sm-12">
                <input type="text" name="name" value="{{$getRecord->name}}" required class="form-control">
            </div>
        </div>
        <div class="row mb-3">
        <label style="display:block; margin-bottom:20px;" class="col-sm-12 col-form-label"><b>Permission</b></label>

        @foreach ($getPermission as $value)
    <div class="row" style="margin-bottom:20px;">
        <div class="col-md-3">
            {{ $value['name'] }}
        </div>
        <div class="col-md-9">
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

                    <div class="col-md-3">
                        <label>
                            <input type="checkbox" {{ $checked }} value="{{ $group['id'] }}" name="permissions_id[]">
                            {{ $group['name'] }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <hr>
@endforeach

    </div>
        <div class="row mb-3">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
