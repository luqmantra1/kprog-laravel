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
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
