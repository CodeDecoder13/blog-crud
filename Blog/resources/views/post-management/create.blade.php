<x-app-layout>
    <div class="container mx-auto py-5">
        <h1 class="text-3xl font-bold mb-4">Create a New Post</h1>

        <form id="postForm" action="{{ route('posts.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea name="content" id="content" required rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300"></textarea>
            </div>

            <div class="flex justify-end space-x-2">
                <button id="postButton" type="submit" class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded hover:bg-gray-200 transition duration-200">Post</button>
                <a href="{{ route('user.post') }}" class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded hover:bg-gray-200 transition duration-200">Cancel</a>
            </div>
        </form>

        <div id="responseMessage" class="mt-4"></div> <!-- For displaying response messages -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
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