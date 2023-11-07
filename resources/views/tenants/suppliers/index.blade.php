@extends('layouts.usercontentNavbarLayout')

@section('title', 'Suppliers')

@section('content')
<div class="row">
  <!-- Total Revenue -->
  <div class="col-16 col-lg-16 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Suppliers</h3>
            <a class="btn btn-info" href="{{ route('tenants.suppliers.invite', tenant('id')) }}">Invite Supplier</a>
        </div>
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
                        <th>email</th>
                        <th>Telephone</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>ZipCode</th>
                        <th>Country</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->email	}}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>{{ $supplier->city }}</td>
                    <td>{{ $supplier->state	}}</td>
                    <td>{{ $supplier->zipcode }}</td>
                    <td>{{ $supplier->country }}</td>
                    <td>
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <a href="{{ route('tenants.suppliers.edit',[tenant('id'), $supplier->id]) }}" class="btn btn-info btn-sm">Edit</a>                                                                           
                            <form action="{{ route('tenants.suppliers.destroy',[tenant('id'), $supplier->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-5">
          {!! $suppliers->links() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection