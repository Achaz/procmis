@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('content')
<div class="row">
  <!-- Total Revenue -->
  <div class="col-16 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
    <div class="row">
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body text-center">
            <div class="h1">{{ \App\Models\Tenant::count() }}</div>
            <div>Accounts</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
