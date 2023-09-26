@extends('layouts/contentNavbarLayout')

@section('title', 'Companies')

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
                                    <th scope="col" width="1%" colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
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
                                        <td><a href="{{ route('company.edit', $company->id) }}"
                                                class="btn btn-info btn-sm">Edit</a></td>
                                        <td>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['company.destroy', $company->id], 'style' => 'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td><a href="{{ route('company.user.manage', $company->id,$company->organisationName) }}"
                                                class="btn btn-info btn-sm">Manage Users</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>               
                    <div class="d-flex">
                        {!! $companies->links() !!}
                    </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection