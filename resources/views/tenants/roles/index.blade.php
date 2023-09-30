@extends('layouts.usercontentNavbarLayout')

@section('title', 'Roles')

@section('content')
<div class="row">
  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div>
          <h2>Roles</h2>
          <p>Manage your roles here.</p>
        </div>
        <a href="{{ route('tenants.roles.create', tenant('id')) }}" class="btn btn-info btn-sm">Add role</a>
      </div>
      <div class="card-body">
          <div class="mt-2">
              @include('layouts.partials.messages')
          </div>
          <table class="table table-hover">
              <tr>
                  <th>Name</th>
                  <th class="text-end">Action</th>
              </tr>
              @foreach ($roles as $key => $role)
              <tr>
                  <td>{{ $role->name }}</td>
                  <td>
                    <div class="d-flex justify-content-end align-items-center gap-2">
                      <a class="btn btn-primary btn-sm" href="{{ route('tenants.roles.edit', [tenant('id'), $role]) }}">Edit</a>
                      <form action="{{ route('tenants.roles.destroy', [tenant('id'), $role]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                      </form>
                    </div>
                  </td>
              </tr>
              @endforeach
          </table>
     </div>
    </div>
  </div>
</div>
@endsection
