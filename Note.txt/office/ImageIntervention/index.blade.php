@extends('backend.layout.admin', ['title' => 'ecommerce', 'name' => 'category'])

@section('head')
@endsection

@section('content')
    <div class="card-header">
        <h2>All Category <a class="float-end" href="{{ route('category.create') }}">Create Category</a></h2>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Priority</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <img src="{{asset(config('imagepath.category').$category->image)}}" width="50">
                        </td>
                        <td>{{ $category->priority }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('category.edit', $category->id) }}"
                                    class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this data?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
{{--                                <a href="{{ route('category.show', $category->id) }}"--}}
{{--                                    class="btn btn-sm btn-outline-primary">--}}
{{--                                    <i class="bi bi-eye-fill"></i>--}}
{{--                                </a>--}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $categories->links() }}
        </div>
    </div>
@endsection

@section('script')
@endsection
