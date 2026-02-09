@extends('admin.layout.admin')

@section('content')
<div class="container">
    <h4>Add Category</h4>

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="mb-3">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
    <select name="category_id" required>
    @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
    </select>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
