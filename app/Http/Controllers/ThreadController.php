<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ThreadController extends Controller
{
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
}
