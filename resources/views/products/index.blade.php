@extends('layouts.admin')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('products.index') }}">
            <div class="row">

                <div class="col-md-4">
                    <input type="text"
                        name="name"
                        value="{{ request('name') }}"
                        class="form-control"
                        placeholder="Search by name">
                </div>

                <div class="col-md-3">
                    <input type="number"
                        name="min_price"
                        value="{{ request('min_price') }}"
                        class="form-control"
                        placeholder="Min price">
                </div>

                <div class="col-md-3">
                    <input type="number"
                        name="max_price"
                        value="{{ request('max_price') }}"
                        class="form-control"
                        placeholder="Max price">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary btn-block">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-box mr-2"></i>Products</h3>
        <a href="{{ route('products.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>Add Product</a>
    </div>

    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            @foreach($products as $product)
            <tr>
                <!-- 🔢 Correct numbering across pages -->
                <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>

                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price, 2) }}</td>

                <td>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('products.destroy', $product) }}"
                        method="POST"
                        class="delete-form"
                        style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
</div>
<div class="d-flex justify-content-center mt-4">
    {{ $products->links('pagination::bootstrap-4') }}
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This product will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>