@extends('layouts/contentNavbarLayout')

@section('title', 'Permissions')

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
           <div class="col-md-12">
           <h1>Permissions</h1>
            Manage your permissions here.
            <div class="mb-3 float-right">         
                <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right">Add permissions</a>              
            </div>
            </div> 
            <div class="mt-2">
                @include('layouts.partials.messages')
            </div>  
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="15%">Name</th>
                        <th scope="col">Guard</th> 
                        <th scope="col" colspan="3" width="1%"></th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td><a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                            <td>
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
             </table>
           </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection