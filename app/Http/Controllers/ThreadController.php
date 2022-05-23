<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }
    /**
     * List threads
     *
     * @return View
     */
    public function index(): View
    {
        $threads = Thread::all();

        return view('threads.index', ['threads' => $threads]);
    }

    /**
     * Show spacific thread
     *
     * @param Thread $thread
     * @return View
     */
    public function show(Thread $thread): View
    {
        return view('threads.show', ['thread' => $thread]);
    }

    /**
     * Store Thread
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $thread = Thread::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        session()->flash('success_message', 'Thread added successfuly.');
        
        return to_route('threads.show', ['thread' => $thread->id]);
    }
}
