<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function userPost()
    {
        $posts = Post::latest()->get(); // Retrieves all posts sorted by latest
        $posts = Post::latest()->paginate(5);
        
        
        return view('userpost', compact('posts'));
    }
    public function createPost()
    {
        return view('post-management.create');
    }
    public function storePost(Request $request)
    {
         // Validation
         $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Store the new post
        Post::create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
            
        ]);
        return redirect()->route('userpost');

    }
    public function show() 
    {
        return view('post-management.show');
    }
    public function edit()
    {
        return view('post-management.edit');
    }
    
}
