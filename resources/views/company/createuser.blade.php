@extends('layouts/usercontentNavbarLayout')

@section('title', 'Company Users')

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
           @if(Session::get('success'))
            <div class="alert alert-success">
                {{session::get('success')}}
            </div>
            @endif
            <form action="{{ route('users.company') }}" method="post">
            @csrf
            <div class="mt-3">
                <label class="form-label" for="name" >Name</label>           
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif        
            </div>
            <div class="mt-3">
                <label class="form-label" for="username" >Username</label>               
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif            
            </div>
            <div class="mt-3">
                <label class="form-label" for="email" >Email Address</label>          
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif             
            </div>
            <div class="mt-3">
                <label class="form-label" for="password">Password</label>               
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif             
            </div>
            <div class="mt-3">
                <label class="form-label" for="password_confirmation">Confirm Password</label>               
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">              
            </div>
            <div class="mt-3">
                <input type="submit" class="btn btn-primary" value="Register">
            </div>                  
          </form>
           </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection