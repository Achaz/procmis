@extends('layouts.usercontentNavbarLayout')

@section('title', 'Roles')

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
                            <th>Name</th>
                        </thead>

                        @foreach ($role->permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="mt-4">
                    <a href="{{ route('tenants.roles.edit', [tenant('id'), $role]) }}" class="btn btn-info">Edit</a>
                    <a href="{{ route('tenants.roles.index', tenant('id')) }}" class="btn btn-dark">Back</a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
