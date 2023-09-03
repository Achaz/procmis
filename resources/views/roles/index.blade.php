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
                 <h1>Roles</h1>
                <div class="lead">
                    Manage your roles here.
                    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Add role</a>
                </div>               
                <div class="mt-2">
                    @include('layouts.partials.messages')
                </div>
                <table class="table table-hover">
                    <tr>
                        <th width="1%">No</th>
                        <th>Name</th>
                        <th width="3%" colspan="3">Action</th>
                    </tr>
                    @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Show</a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="d-flex">
                    {!! $roles->links() !!}
                </div>    
           </div>      
        </div>
      </div>
    </div>
  </div>
</div>
@endsection