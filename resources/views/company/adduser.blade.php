@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Company Users')

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
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <h2>Company Name: {{ $company->organisationName }}</h2>
                                </div>
                                <div class="pull-left">
                                    <button type="button" id="submit" class="btn btn-success" data-toggle="modal" data-target="#demoModal" onclick="$('#demoModal').modal('show')">Add User</button>
                                </div>
                            </div>
                            <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="demoModalLabel">Add User to Company</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#demoModal').modal('hide')">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @php
                                        $company_user_ids = $company_users->pluck("id")->all();

                                        @endphp
                                        <form action={{route('company.user.sync',$company->id)}} method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <label class="form-label" for="category">Select User</label>
                                                <div class="mt-2">
                                                    <select class="form-select" multiple name="user_ids[]">

                                                        <option value=0>Select User</option>
                                                        @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{in_array( $user->id,$company_user_ids)?"selected":null }}>{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" onclick="$('#demoModal').modal('hide')">Close</button>
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        
                                        <th scope="col" width="1%" colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($company_users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role }}</td>

                                        @if ($user->pivot->status ==5)
                                        <td></td>
                                        <td></td>
                                        @else
                                        <td>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['company.destroy', $user->id], 'style' => 'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td><button type="button" id="submit"  class="btn btn-info btn-sm" data-toggle="modal" data-target="#demoModal" onclick="$('#demoModal').modal('show')">Manage Roles</but</td>
                                        @endif

                                    </tr>
                                    @endforeach
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
@section('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection
@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection