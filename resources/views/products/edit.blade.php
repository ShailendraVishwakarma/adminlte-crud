@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">Edit Product</div>

    <div class="card-body">
        <form method="POST" action="{{ route('products.update',$product) }}">
            @csrf @method('PUT')

            <div class="form-group">
                <label>Name</label>
                <input name="name" value="{{ $product->name }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Price</label>
                <input name="price" value="{{ $product->price }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
