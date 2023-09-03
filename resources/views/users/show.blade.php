@extends('layouts/contentNavbarLayout')

@section('title', 'Users')

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
           <div class="container mt-4">
            <h1>Show user</h1>
            <div class="lead"> </div>
            <div class="container mt-4">
                <div> Name: {{ $user->name }} </div>
                <div> Email: {{ $user->email }} </div>
                <div> Username: {{ $user->username }} </div>
            </div>

            <div class="mt-4"> <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a> <a
                    href="{{ route('users.index') }}" class="btn btn-dark">Back</a> </div>  
            </div> 
           </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection