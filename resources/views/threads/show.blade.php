<x-layouts.app>
    <x-slot name="title">{{ $thread->title }}</x-slot>

    <x-slot name="rightSection">
        <div>test</div>
    </x-slot>

    <x-slot name="mainSection">
        <x-cards.thread :thread="$thread" />

            @if ($thread->replies_count)
                <div class="card text-dark mb-4">   
                    @foreach ($replies as $reply)
                        <x-cards.reply :reply="$reply" />

                        @if (auth()->check())
                            <hr class="my-0" />
                        @else
                            @if (! $loop->last)
                                <hr class="my-0" />
                            @endif
                        @endif
                    @endforeach
                </div>
            @endif

            {{ $replies->links() }}
        
            <div class="card text-dark mb-5">   
                @if (auth()->check())
                    <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                        <form method="POST" action="{{ route('replies.store', $thread) }}">
                            @csrf
                            <div class="d-flex flex-start w-100">
                                <img class="rounded-circle shadow-1-strong me-3"
                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40"
                                    height="40" />
                                <div class="form-outline w-100">
                                    <textarea name="body"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Say Something"
                                        style="background: #fff;"></textarea>
                                    
                                </div>
                            </div>
                            <div class="float-end mt-2 pt-1">
                                <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                            </div>
                        </form>
                    </div>
                @else
                    <p class="text-center mt-3">Please <a href="{{ route('login') }}">Sing In</a> to reply in thread.</p>
                @endif
            </div>
        
          
    </x-slot>

    <x-slot name="leftSection">
        <div>test</div>
    </x-slot>

</x-layouts.app>