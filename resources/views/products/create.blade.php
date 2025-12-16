@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">Add Product</div>

    <div class="card-body">
        <form method="POST" action="{{ route('products.store') }}">
            @csrf

            <div class="form-group">
                <label>Name</label>
                <input name="name" class="form-control">
            </div>

            <div class="form-group">
                <label>Price</label>
                <input name="price" class="form-control">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Save</button>
        </form>
    </div>
</div>
@endsection
