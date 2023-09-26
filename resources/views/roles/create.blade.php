@extends('layouts/contentNavbarLayout')

@section('title', 'Roles')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-6">
            <div class="card-body">
              <h1>Add new role</h1>
              <div class="lead">
                  Add new role and assign permissions.
              </div>
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <strong>Whoops!</strong> There were some problems with your input.<br><br>
                      <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                      </ul>
                  </div>
              @endif
              <div class="container mt-4">
                  <form method="POST" action="{{ route('roles.store') }}">
                      @csrf
                      <div class="mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input value="{{ old('name') }}" 
                              type="text" 
                              class="form-control" 
                              name="name" 
                              placeholder="Name" required>
                      </div>
                      
                      <label for="permissions" class="form-label">Assign Permissions</label>
                      <div class="mb-3">
                      <table class="table table-striped">
                          <thead>
                              <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                              <th scope="col" width="20%">Name</th>
                              <th scope="col" width="1%">Guard</th> 
                          </thead>

                          @foreach($permissions as $permission)
                              <tr>
                                  <td>
                                      <input type="checkbox" 
                                      name="permission[{{ $permission->name }}]"
                                      value="{{ $permission->name }}"
                                      class='permission'>
                                  </td>
                                  <td>{{ $permission->name }}</td>
                                  <td>{{ $permission->guard_name }}</td>
                              </tr>
                          @endforeach
                      </table>
                      </div>
                      <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Role</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-dark">Back</a>
                      </div>
                    </form>
                </div>           
            </div>
         </div>
      </div>
    </div>
  </div>
</div>
@endsection