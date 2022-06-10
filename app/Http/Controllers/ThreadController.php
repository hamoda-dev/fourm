<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * List threads
     *
     * @return View
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('threads.index', ['threads' => $threads]);
    }

    /**
     * Show spacific thread
     *
     * @param Thread $thread
     * @return View
     */
    public function show(string $channel, Thread $thread): View
    {
        return view('threads.show', [
            'thread' => $thread,
            'channel' => $channel,
            'replies' => $thread->replies()->paginate(10),
        ]);
    }

    /**
     * Show Fourm to create thread
     *
     * @return View
     */
    public function create(): View
    {
        return view('threads.create');
    }

    /**
     * Store Thread
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'channel_id' => ['required', 'exists:channels,id'],
            'title' => ['required'],
            'body' => ['required'],
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => $request->channel_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        session()->flash('success_message', 'Thread added successfuly.');
        
        return redirect($thread->path());
    }

    private function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists) {
            $threads = $channel->threads()->latest();
        }

        return $threads->get();
    }
}
