@extends('layouts/usercontentNavbarLayout')

@section('title', 'Companies')

@section('content')
<div class="row">
  <div class="col-16 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
          <h4>Your company Profile</h4>
          <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Company Name</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              {{ $company->organisationName }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Category</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              {{ $company->procurementCategory }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Description</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              {{ $company->briefDescription }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Phone</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{ $company->companyPhoneNumber }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Country</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              {{ $company->country }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Registration Number</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              {{ $company->registrationNumber }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">TaxID</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              {{ $company->taxId }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Address</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              {{ $company->address }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">City</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              {{ $company->city }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Region</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              {{ $company->region }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Zip Code</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              {{ $company->zip_code }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <a class="btn btn-info" href="{{ route('tenants.profile.edit', [tenant('id'), $company->id]) }}">Edit</a>
              </div>
            </div>
          </div>
        </div>
    </div>  
</div>
@endsection