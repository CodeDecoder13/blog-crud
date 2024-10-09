<x-app-layout>
    <div class="container mx-auto py-5">
        <h1 class="text-3xl font-bold mb-4">Create a New Post</h1>

        <form action="{{ route('posts.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
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
                <button type="submit" class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded hover:bg-gray-200 transition duration-200">Post</button>
                <a href="{{ route('user.post') }}" class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded hover:bg-gray-200 transition duration-200">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
