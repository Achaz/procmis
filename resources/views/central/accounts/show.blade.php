@extends('layouts/contentNavbarLayout')

@section('title', 'Users')

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
                <div> Name: {{ $account->name }} </div>
                <div> Email: {{ $account->email }} </div>
                <div> Username: {{ $account->username }} </div>
            </div>

            <div class="mt-4"> <a href="{{ route('central.accounts.edit', $account) }}" class="btn btn-info">Edit</a> <a
                    href="{{ route('central.accounts.index') }}" class="btn btn-dark">Back</a> </div>
            </div>
           </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
