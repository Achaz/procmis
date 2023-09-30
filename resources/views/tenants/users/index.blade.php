@extends('layouts.usercontentNavbarLayout')

@section('title', 'Users')

@section('content')
<div class="row">
  <div class="col-16 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Users</h3>
        <a class="btn btn-info" href="{{ route('tenants.users.create', tenant('id')) }}">Create User</a>
      </div>
       <div class="card-body">
         <div class="table-responsive text-nowrap">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Username</th>
                          <th>Roles</th>
                          <th scope="col">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $user)
                          <tr>
                              <th scope="row">{{ $user->id }}</th>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>{{ $user->username }}</td>
                              <td></td>
                              <td>
                                <div class="d-flex align-items-center justify-content-end gap-2">
                                  <a href="{{ route('tenants.users.show', [tenant('id'), $user->id]) }}"
                                     class="btn btn-warning btn-sm">Show</a>
                                  <a href="{{ route('tenants.users.edit', [tenant('id'), $user->id]) }}"
                                     class="btn btn-info btn-sm">Edit</a>
                                  @if(tenant('email') !== $user->email)
                                    <form action="{{ route('tenants.users.destroy', [tenant('id'), $user->id]) }}">
                                      @csrf
                                      @method('delete')
                                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                  @endif
                                </div>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
          <div class="d-flex">
              {!! $users->links() !!}
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
