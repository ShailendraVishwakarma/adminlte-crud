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

                <div class="col-md-1">
                    <button class="btn btn-primary btn-block">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>

                <div class="col-md-1">
                    <!-- Reset Button -->
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-undo"></i>
                    </a>
                </div>

            </div>

        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h3 class="card-title mb-0">
            <i class="fas fa-box mr-2"></i>Products
        </h3>

        <!-- Spacer -->
        <div class="ml-auto">
            <a href="{{ route('products.export') }}" class="btn btn-success mr-2">
                <i class="fas fa-file-csv"></i> Export CSV
            </a>

            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Product
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        <i class="fas fa-check-circle mr-1"></i>
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

        @forelse($products as $product)
        <tr>
            <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ number_format($product->price, 2) }}</td>
            <td>{{ $product->description }}</td>
            <td class="text-nowrap">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm mb-0">
                    Edit
                </a>

                <form action="{{ route('products.destroy', $product) }}"
                    method="POST"
                    class="delete-form d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        Delete
                    </button>
                </form>
            </td>

        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-muted">
                No data found
            </td>
        </tr>
        @endforelse
    </table>

</div>
<!-- <div class="d-flex justify-content-center mt-4"> -->
<!-- {{ $products->links('pagination::bootstrap-4') }} -->
<div class="mt-3">
    {{ $products->links('pagination::bootstrap-5') }}
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