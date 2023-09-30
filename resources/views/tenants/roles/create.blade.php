@extends('layouts.usercontentNavbarLayout')

@section('title', 'Roles')

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
                  <form method="POST" action="{{ route('tenants.roles.store', tenant('id')) }}">
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
                              <tr>
                                <th scope="col">Name</th>
                              </tr>
                          </thead>

                          @foreach($permissions as $permission)
                              <tr>
                                  <td>
                                    <label>
                                      <input type="checkbox"
                                             name="permission[{{ $permission->name }}]"
                                             value="{{ $permission->name }}"
                                             class='permission'>
                                      {{ $permission->name }}
                                    </label>
                                  </td>
                              </tr>
                          @endforeach
                      </table>
                      </div>
                      <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Role</button>
                        <a href="{{ route('tenants.roles.index', tenant('id')) }}" class="btn btn-dark">Back</a>
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
