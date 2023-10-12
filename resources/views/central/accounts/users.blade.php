@extends('layouts/contentNavbarLayout')

@section('title', 'Approvals')

@section('content')
<div class="row">
  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Accounts Pending Approval</h3>
      </div>
       <div class="card-body">
        @if (session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <p>{{ session('error') }}</p>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if(Session::get('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session::get('success')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
         <div class="table-responsive text-nowrap">
              <table class="table table-striped">
              <thead>
                      <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Registered at</th>
                          <th class="text-end">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $account->name }}</td>
                        <td>{{ $account->email }}</td>
                        <td>{{ $account->created_at }}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-end gap-2">                                  
                                <form action="{{ route('central.accounts.approve', $account) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
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