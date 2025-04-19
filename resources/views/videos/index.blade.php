@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Videos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Category filter form -->
                    <form action="{{ route('videos.index') }}" method="GET" class="mb-4">
                        <div class="form-group">
                            <label for="category">Filter by Category:</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Categories</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $video)
                                <tr>
                                    <th scope="row">{{ $video->id }}</th>
                                    <td>{{ $video->title }}</td>
                                    <td>
                                        @foreach ($video->categories as $category)
                                            <span class="badge badge-primary">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('videos.show', $video) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('videos.edit', $video) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('videos.destroy', $video) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this video?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $videos->links() }}

                    <a href="{{ route('videos.create') }}" class="btn btn-success">Upload New Video</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection