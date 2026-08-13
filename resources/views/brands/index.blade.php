@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Brands</h2>
    <a href="{{ route('brands.create') }}" class="btn btn-primary mb-3">Add Brand</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Brand Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <a href="{{ route('brands.edit', $brand) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this brand?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No brands found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection