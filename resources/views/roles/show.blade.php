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
                <h1>{{ ucfirst($role->name) }} Role</h1>
                <div class="container mt-4">

                    <h3>Assigned permissions</h3>

                    <table class="table table-striped">
                        <thead>
                            <th scope="col" width="20%">Name</th>
                            <th scope="col" width="1%">Guard</th>
                        </thead>

                        @foreach ($rolePermissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="mt-4">
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Edit</a>
                    <a href="{{ route('roles.index') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection