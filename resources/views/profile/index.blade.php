@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">My Profile</h3>

                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

                <div class="card-body">

                    <div class="text-center mb-4">
                        <i class="fas fa-user-circle fa-5x text-secondary"></i>
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>

                        <tr>
                            <th>Account Created</th>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                        </tr>
                    </table>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection