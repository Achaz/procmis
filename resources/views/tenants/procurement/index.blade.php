@extends('layouts.usercontentNavbarLayout')

@section('title', 'Procurement')

@section('content')
<div class="row">
  <!-- Total Revenue -->
  <div class="col-16 col-lg-16 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="card-body">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Procurement Plans</h3>
                <a class="btn btn-info" href="{{ route('tenants.procurement.create', tenant('id')) }}">Create Plan</a>
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
                        <th>Title</th>
                        <th>Financial Period</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($procurementplans as $procurementplan)
                <tr>
                    <td>{{ $procurementplan->title }}</td>
                    <td>{{ $procurementplan->financialperiod }}</td>
                    <td><a href="{{ route('tenants.procurement.download', [tenant('id'), $procurementplan->id]) }}">{{ $procurementplan->details }}</a></td>
                    <td>{{ $procurementplan->status }}</td>
                    <td>
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <a href="{{ route('tenants.procurement.edit',[tenant('id'), $procurementplan->id]) }}" class="btn btn-info btn-sm">Edit</a>                                                                           
                            <form action="{{ route('tenants.procurement.destroy',[tenant('id'), $procurementplan->id]) }}" method="post">
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
          {!! $procurementplans->links() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection