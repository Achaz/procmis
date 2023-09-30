@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

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
  <!-- Total Revenue -->
  <div class="col-16 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Companies</h2>
        <a href="{{ route('invitations.create') }}" class="btn btn-info">Invite a Company</a>
      </div>
      <div class="card-body">
        <table class="table table-borderless table-striped">
          <thead>
            <tr>
              <th>Company</th>
              <th>Registered</th>
            </tr>
          </thead>
          <tbody>
            @forelse($tenants as $tenant)
              <tr>
                <td>{{ $tenant->id }}</td>
                <td>{{ $tenant->created_at->toDateString() }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="2">
                  <p>You do not have any companies registered. Send one or more invites.</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
