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
    <div class="card mb-12">
      <div class="row row-bordered g-0">
        <div class="col-md-12">
           <div class="card-body">
           <div class="card-header d-flex justify-content-between align-items-center">
            Add new permission.
           </div>
            <div class="container mt-6">
                <form method="POST" action="{{ route('permissions.store') }}">
                    @csrf
                    <div class="col-sm-6">
                        <label for="name" class="form-label">Name</label>
                        <div class="mb-3">
                            <div class="input-group input-group-merge">                     
                                <input value="{{ old('name') }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    placeholder="Name" required>
                                    @if ($errors->has('name'))
                                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn rounded-pill btn-primary">Save permission</button>
                        <a href="{{ route('permissions.index') }}" class="btn rounded-pill btn-dark">Back</a>   
                    </div>              
                </form>
            </div>
           </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection