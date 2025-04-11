@extends('panel.layout.app')

@section('content')

<!--  Main wrapper -->
    <div class="body-wrapper">
    
      <div class="body-wrapper-inner">
        <div class="container-fluid">
        <div class="card-header border-0 d-flex justify-content-between align-items-center">
                  <h3 class="mb-0">Add New Role</h3>
                </div>

                <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="inputText">Name</label>
                    <input type="text" class="form-control" name="name" required id="inputrole" placeholder="new role">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
      </div>
    </div>
@endsection