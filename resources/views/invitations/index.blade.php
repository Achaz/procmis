@extends('layouts/contentNavbarLayout')

@section('title', 'Invitations')

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
            @if (!empty($invitations))
            <div class="table-responsive text-nowrap">
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Invitation Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invitations as $invitation)
                                <tr>
                                    <td><a href="mailto:{{ $invitation->email }}">{{ $invitation->email }}</a></td>
                                    <td>{{ $invitation->created_at }}</td>
                                    <td>
                                        <kbd>{{ $invitation->getLink() }}</kbd>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <p>No invitation requests!</p>
                @endif
            </div>      
        </div>
      </div>
    </div>
  </div>
</div>
@endsection