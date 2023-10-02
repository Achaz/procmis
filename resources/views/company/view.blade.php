@extends('layouts/usercontentNavbarLayout')

@section('title', 'Companies')

@section('content')
<div class="row">
  <div class="col-16 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-14">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Company Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>Registration Number</th>
                                <th>TaxID</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Region</th>
                                <th>Zip Code</th>
                            
                            </tr>
                        </thead>
                        <tbody>                               
                            <tr>
                                <th scope="row">{{ $company->id }}</th>
                                <td>{{ $company->organisationName }}</td>
                                <td>{{ $company->procurementCategory }}</td>
                                <td>{{ $company->briefDescription }}</td>
                                <td>{{ $company->companyPhoneNumber }}</td>
                                <td>{{ $company->country }}</td>
                                <td>{{ $company->registrationNumber }}</td>
                                <td>{{ $company->taxId }}</td>
                                <td>{{ $company->address }}</td>
                                <td>{{ $company->city }}</td>
                                <td>{{ $company->region }}</td>
                                <td>{{ $company->zip_code }}</td>
                                <td><a href="{{ route('tenants.profile.edit', [tenant('id'), $company->id]) }}"
                                        class="btn btn-info btn-sm">Edit</a></td>                                   
                            </tr>                             
                        </tbody>
                    </table>
                </div>               
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection