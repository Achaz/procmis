@extends('layouts.contentNavbarLayout')

@section('title', 'Users')

@section('content')
<div class="row">
  <div class="col-16 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Accounts</h3>
        <a class="btn btn-info" href="{{ route('central.invitations.create') }}">Invite User</a>
      </div>
       <div class="card-body">
        @if (session('error'))
          <div class="alert alert-danger">
              <p>{{ session('error') }}</p>
          </div>
        @endif
         <div class="table-responsive text-nowrap">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Username</th>
                          <th>Active</th>
                          <th class="text-end">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($accounts as $account)
                          <tr>
                              <td>{{ $account->name }}</td>
                              <td>{{ $account->email }}</td>
                              <td>{{ $account->username }}</td>
                              <td>{{ $account->active ? 'Yes' : 'No' }}</td>
                              <td>
                                <div class="d-flex align-items-center justify-content-end gap-2">
                                  <a href="{{ route('central.accounts.show', $account) }}"  class="btn btn-success btn-sm">Company Profile</a>
                                  @if($account->active)
                                  <form action="{{ route('central.accounts.deactivate', $account) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Deactivate</button>
                                  </form>
                                  @else
                                    <form action="{{ route('central.accounts.activate', $account) }}" method="post">
                                      @csrf
                                      <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                    </form>
                                  @endif
                                  <a href="{{ route('central.accounts.edit', $account->id) }}"
                                     class="btn btn-info btn-sm">Edit</a>
                                  @if(tenant('email') !== $account->email)
                                    <form action="{{ route('central.accounts.destroy', $account) }}" method="post">
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
              {!! $accounts->links() !!}
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
