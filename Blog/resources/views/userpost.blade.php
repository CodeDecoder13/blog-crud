<x-app-layout>

<div class="container mx-auto py-5">
    <!-- Heading -->
    <h1 class="text-2xl font-bold mb-5 text-center">All Posts</h1>

    <!-- Button to Create New Post -->
    <div class="text-right mb-5">
        <a href="{{ route('post.create') }}" 
           class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-500 transition duration-200">
           Create Post
        </a>
    </div>

    <!-- Posts List -->
    @if($posts->isEmpty())
        <p class="text-center text-gray-600">No posts available. Be the first to create one!</p>
    @else
        <div class="space-y-12">
            @foreach($posts as $post)
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-5">
                <!-- Post Title and Author -->
                <div class="mb-3">
                    <h5 class="text-lg font-semibold">{{ $post->title }}</h5>
                    <small class="text-gray-500">Posted by {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</small>
                </div>

                <!-- Post Content (truncated for preview) -->
                <p class="text-gray-700 mb-3">{{ Str::limit($post->content, 150) }}</p>

                <!-- Post Interaction Buttons (View, Edit, etc.) -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('posts.show', $post->id) }}" 
                       class="text-blue-600 font-bold hover:underline">
                       View Full Post
                    </a>
                    <div class="flex space-x-3">
                        
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 text-white font-bold py-1 px-3 rounded hover:bg-red-500 transition duration-200">
                                    Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-5">
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>

        @if(Auth::check() && Auth::user()->role === 'admin')
        <!-- Admin Controls -->
        <div class="flex space-x-3 mt-5">
            @foreach($posts as $post) <!-- Assuming you want admin controls for each post -->
                @foreach($post->comments as $comment) <!-- Ensure you have access to comments for each post -->
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white font-bold py-1 px-3 rounded hover:bg-red-500">Delete Comment</button>
                    </form>
                    
                    <form action="{{ route('comments.report', $comment->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-yellow-600 text-white font-bold py-1 px-3 rounded hover:bg-yellow-500">Report Comment</button>
                    </form>

                    <form action="{{ route('users.report', $comment->user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-yellow-600 text-white font-bold py-1 px-3 rounded hover:bg-yellow-500">Report User</button>
                    </form>
                @endforeach
            @endforeach
        </div>
        @endif
    @endif
</div>
</x-app-layout>
