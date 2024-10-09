<x-app-layout>

<div class="container mx-auto py-5">
    <!-- Heading -->
    <h1 class="text-2xl font-bold mb-5 text-center">All Posts</h1>

    <!-- Button to Create New Post -->
    <div class="text-right mb-5">
        <a href="#" id="createPostButton" 
           class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-500 transition duration-200">
           Create Post
        </a>
    </div>

    <!-- Modal for Create/Update Post -->
    <div id="postModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-5 w-1/3">
            <h2 class="text-lg font-bold mb-4" id="modalTitle">Create Post</h2>
            <form id="postForm">
                @csrf
                <input type="hidden" id="postId" name="postId">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeModal" class="bg-gray-300 text-gray-700 font-bold py-1 px-3 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white font-bold py-1 px-3 rounded">Save</button>
                </div>
            </form>
            <div id="responseMessage" class="mt-4"></div> <!-- Response message area -->
        </div>
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

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#createPostButton').on('click', function() {
            $('#postModal').removeClass('hidden');
            $('#modalTitle').text('Create Post');
            $('#postForm')[0].reset();
            $('#postId').val('');
            $('#responseMessage').html(''); // Clear previous messages
        });

        $('#closeModal').on('click', function() {
            $('#postModal').addClass('hidden');
        });

        $('#postForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                type: 'POST',
                url: '{{ route("posts.store") }}', // Ensure this route is defined
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    $('#responseMessage').html('<div class="text-green-600">' + response.message + '</div>');
                    $('#postForm')[0].reset(); // Reset the form
                    
                    // Redirect after a short delay
                    setTimeout(function() {
                        window.location.href = '{{ route("user.post") }}'; // Redirect after successful post
                    }, 2000); // 2 seconds delay
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '<div class="text-red-600"><ul>';
                    $.each(errors, function(key, value) {
                        errorMessage += '<li>' + value[0] + '</li>'; // Display the first error message for each field
                    });
                    errorMessage += '</ul></div>';
                    $('#responseMessage').html(errorMessage);
                }
            });
        });
    });
</script>
</x-app-layout>