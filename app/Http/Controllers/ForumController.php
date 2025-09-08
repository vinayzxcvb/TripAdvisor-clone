<?php

namespace App\Http\Controllers;

use App\Events\NewForumPost;
use App\Models\ForumThread;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    

    public function index()
    {
        $threads = ForumThread::with('user')->latest()->paginate(20);
        return view('forums.index', compact('threads'));
    }

    public function show(ForumThread $thread)
    {
        $thread->load(['user', 'posts.user']);
        return view('forums.show', compact('thread'));
    }

    public function storeThread(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
        ]);

        $thread = auth()->user()->forumThreads()->create($validated);

        return redirect()->route('forums.show', $thread);
    }

    public function storePost(Request $request, ForumThread $thread)
    {
        $validated = $request->validate([
            'body' => 'required|string|min:5',
        ]);

        $post = $thread->posts()->create([
            'user_id' => auth()->id(),
            'body' => $validated['body'],
        ]);

        // Broadcast an event for real-time notifications
        broadcast(new NewForumPost($post))->toOthers();

        return back()->with('success', 'Your reply has been posted.');
    }
}