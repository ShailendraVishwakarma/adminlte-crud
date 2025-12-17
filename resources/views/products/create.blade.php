@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">Add Product</div>

    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('products.store') }}">
            @csrf

            <div class="form-group">
                <label>Product Name</label>
                <input type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror">

                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Price</label>
                <input type="number"
                    name="price"
                    value="{{ old('price') }}"
                    class="form-control @error('price') is-invalid @enderror">

                @error('price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Save</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>
@endsection