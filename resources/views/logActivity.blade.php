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
  <div class="col-16 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-14">
           <div class="card-body">
                <!--<div class="table-responsive text-nowrap"> -->
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Subject</th>
                            <th>URL</th>
                            <th>Method</th>
                            <th>Ip</th>
                            <th width="300px">User Agent</th>
                            <th>User Id</th>
                            <th>Action</th>
                        </tr>
                        @if($logs->count())
                            @foreach($logs as $key => $log)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $log->subject }}</td>
                                <td class="text-success">{{ $log->url }}</td>
                                <td><label class="label label-info">{{ $log->method }}</label></td>
                                <td class="text-warning">{{ $log->ip }}</td>
                                <td class="text-danger">{{ $log->agent }}</td>
                                <td>{{ $log->user_id }}</td>
                                <td><button class="btn btn-danger btn-sm">Delete</button></td>
                            </tr>
                            @endforeach
                        @endif
                    </table>
               <!-- </div> -->
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection