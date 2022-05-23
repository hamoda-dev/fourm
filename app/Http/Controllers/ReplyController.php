<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Thread $thread): RedirectResponse
    {
        $thread->replies()->create([
            'user_id' => auth()->user()->id,
            'thread_id' => $thread->id,
            'body' => $request->body,
        ]);

        session()->flash('success_message', 'Replied Successfuly');
        return to_route('threads.show', $thread);
    }
}
