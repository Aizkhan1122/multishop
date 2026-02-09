@extends('admin.layout.admin')

@section('content')
<div class="container">
    <h4>Edit Category</h4>

    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Category Name</label>
            <input type="text" name="name"
                   value="{{ $category->name }}"
                   class="form-control" required>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
