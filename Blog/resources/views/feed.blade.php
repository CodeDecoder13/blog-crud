{{-- resources/views/posts/index.blade.php --}}
<x-app-layout>

<div class="container mx-auto py-5">
    <!-- Heading -->
    <h1 class="text-2xl font-bold mb-5 text-center">All Posts</h1>

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
                    
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

</x-app-layout>