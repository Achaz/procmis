@extends('layouts.usercontentNavbarLayout')

@section('title', 'Roles')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-md-6">
                        <div class="card-body">

                            <h1>Update role</h1>
                            <div class="lead">
                                Edit role and manage permissions.
                            </div>

                            <div class="container mt-4">

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('tenants.roles.update', [tenant('id'), $role]) }}">
                                    @method('put')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input value="{{ $role->name }}" type="text" class="form-control" name="name"
                                               placeholder="Name" required>
                                    </div>

                                    <label for="permissions" class="form-label">Assign Permissions</label>

                                    <table class="table table-striped mb-5">
                                        <thead>
                                          <tr>
                                            <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                                          </tr>
                                        </thead>

                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>
                                                  <label>
                                                    <input type="checkbox" name="permission[{{ $permission->name }}]"
                                                           value="{{ $permission->name }}" class='permission'
                                                      {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                    {{ $permission->name }}
                                                  </label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>

                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <a href="{{ route('tenants.roles.index', tenant('id')) }}" class="btn btn-dark">Back</a>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('[name="all_permission"]').on('click', function () {

                if ($(this).is(':checked')) {
                    $.each($('.permission'), function () {
                        $(this).prop('checked', true);
                    });
                } else {
                    $.each($('.permission'), function () {
                        $(this).prop('checked', false);
                    });
                }

            });
        });
    </script>
@endsection
