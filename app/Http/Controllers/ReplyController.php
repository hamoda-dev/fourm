<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }

    /**
     * Store New Reply
     *
     * @param Request $request
     * @param Thread $thread
     * @return RedirectResponse
     */
    public function store(Request $request, Thread $thread): RedirectResponse
    {
        $thread->replies()->create([
            'user_id' => auth()->user()->id,
            'thread_id' => $thread->id,
            'body' => $request->body,
        ]);

        session()->flash('success_message', 'Replied Successfuly');
        return redirect($thread->path());
    }
}
