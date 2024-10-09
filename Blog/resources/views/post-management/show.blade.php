<x-app-layout>
    <div class="container mx-auto py-4">

        <!-- Post Details Section -->
        <div class="bg-white shadow-md rounded-lg mb-4 p-4">
            <h1 class="text-2xl font-bold mb-2">{{ $post->title }}</h1>
            <p class="text-gray-700 mb-2">{{ $post->content }}</p>
            <small class="text-gray-500">Posted by {{ $post->user->name }} on {{ $post->created_at->format('F j, Y') }}</small>
        </div>

        <!-- Back to Posts Button -->
        <div class="mb-4">
            <a href="{{ route('user.post') }}" class="inline-flex items-center bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded hover:bg-gray-200 transition duration-200">
                <i class="bi bi-arrow-left-circle"></i> Back to All Posts
            </a>
        </div>

        <!-- Add Comment Form -->
        <div class="bg-white shadow-md mb-4 p-4 rounded-lg">
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="content" class="block text-sm font-medium text-gray-700">Your Comment</label>
                    <textarea class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300" id="content" name="content" rows="3" required placeholder="Share your thoughts..."></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-500 transition duration-200">
                    <i class="bi bi-chat"></i> Add Comment
                </button>
            </form>
        </div>

        <!-- Comments Section -->
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4 border-b">
                <h4 class="font-bold">Comments ({{ $post->comments->count() }})</h4>
            </div>
            <div class="p-4">
                @if($post->comments->isEmpty())
                    <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                @else
                    @foreach ($post->comments as $comment)
                        <div class="border rounded p-3 mb-3">
                            <p class="mb-1">{{ $comment->content }}</p>
                            <small class="text-gray-500">Commented by {{ $comment->user->name }} on {{ $comment->created_at->format('F j, Y, g:i a') }}</small>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</x-app-layout>