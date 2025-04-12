@extends('panel.layout.app')

@section('content')

<!--  Main wrapper -->
    <div class="body-wrapper">
    
      <div class="body-wrapper-inner">
        <div class="container-fluid">
        <div class="card-header border-0 d-flex justify-content-between align-items-center">
                  <h3 class="mb-0">Add New Role</h3>
                </div>
                <form action="{{ url('panel/role/add') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="inputText">Name</label>
                    <input type="text" class="form-control" name="name" required id="inputrole" placeholder="new role">
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
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" value="{{ $group['id'] }}"name="permissions_id[]" value="{{ $group['name'] }}">
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

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

        </div>
      </div>
    </div>

@endsection