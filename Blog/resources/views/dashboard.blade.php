<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Welcome back, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600">You're in!</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <h4 class="font-bold text-lg mb-2">Your Posts</h4>
                    <p class="text-gray-700">View, edit, or delete your posts.</p>
                    <a href="{{ route('user.post') }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Manage Posts</a>
                </div>

                <!-- Card 2 -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <h4 class="font-bold text-lg mb-2">Create New Post</h4>
                    <p class="text-gray-700">Share your thoughts with the community.</p>
                    <a href="{{ route('posts.create') }}" class="mt-4 inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-200">Create Post</a>
                </div>

                <!-- Card 3 -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <h4 class="font-bold text-lg mb-2">Profile Settings</h4>
                    <p class="text-gray-700">Update your profile information.</p>
                    <a href="{{ route('profile.edit') }}" class="mt-4 inline-block bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600 transition duration-200">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>