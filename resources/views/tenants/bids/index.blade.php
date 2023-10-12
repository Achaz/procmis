@extends('layouts.usercontentNavbarLayout')

@section('title', 'Bids')

@section('content')
<div class="row">
  <!-- Total Revenue -->
  <div class="col-16 col-lg-16 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Bids</h3>
            <a class="btn btn-info" href="{{ route('tenants.bids.create', tenant('id')) }}">Create Bid</a>
        </div>
          @if (session('error'))
          <div class="alert alert-danger">
              <p>{{ session('error') }}</p>
          </div>
          @endif
          @if (session('success'))
          <div class="alert alert-success">
              <p>{{ session('success') }}</p>
          </div>
          @endif
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Procurement Plan</th>
                        <th>Subject</th>
                        <th>Ref Number</th>
                        <th>Type</th>
                        <th>Summary</th>
                        <th>Deadline</th>
                        <th>Documents</th>
                        <th>Bid Period</th>
                        <th>Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($bids as $bid)
                <tr>
                    <td>{{ $bid->procurementplan }}</td>
                    <td>{{ $bid->procurementsubject	}}</td>
                    <td>{{ $bid->referenceNumber }}</td>
                    <td>{{ $bid->procurementtype }}</td>
                    <td>{{ $bid->summary }}</td>
                    <td>{{ $bid->submissiondeadline	}}</td>
                    <td><a href="{{ route('tenants.bids.download', [tenant('id'), $bid->id]) }}">{{ $bid->documents }}</td>
                    <td>{{ $bid->displayperiod }}</td>
                    <td>{{ $bid->status }}</td>
                    <td>
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <a href="{{ route('tenants.bids.edit',[tenant('id'), $bid->id]) }}" class="btn btn-info btn-sm">Edit</a>                                                                           
                            <form action="{{ route('tenants.bids.destroy',[tenant('id'), $bid->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-5">
          {!! $bids->links() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
