@extends('layouts.admin')

@section('title', 'Product Logs')

@section('content_header')
    <h1>Product Logs</h1>
@stop

@section('content')
<?php
// dd($logs);
?>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Total Products</th>
                    <th>Status</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $key => $log)
                <tr @if($log->total_products < 5) class="table-danger" @endif>
                    <td>{{ $logs->firstItem() + $key }}</td>
                    <td>{{ $log->user_name }}</td>
                    <td>{{ $log->total_products }}</td>
                    <td>{{ $log->status }}</td>
                    <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-3">
            {{ $logs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@stop
