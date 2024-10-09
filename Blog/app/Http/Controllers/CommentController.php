<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Validate the incoming request
        $request->validate([
            'content' => 'required|string',
        ]);

        // Create a new comment
        $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(), // Assuming comments are linked to authenticated users
        ]);

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Comment $comment)
    {
    $comment->delete();

    return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    public function report(Comment $comment)
    {
    // Add your report logic here
    return redirect()->back()->with('success', 'Comment reported.');
    }
}
