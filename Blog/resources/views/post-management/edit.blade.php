@extends('layouts.app')

@section('content')
<div class="container mx-auto py-5">

<div class="text-center mb-5">
    <h1>Edit Post</h1>
</div>
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" required>{{ $post->content }}</textarea>
        </div>
        <button type="submit" style="background-color: blue; color: white;" class="font-bold py-2 px-4 rounded hover:bg-blue-500 transition duration-200">Update</button>
        <button type="submit" class="bg-red-600 text-white font-bold py-2 px-4 w-small rounded hover:bg-red-500 transition duration-200">Cancel</button>
    </form>
</div>
@endsection
