<x-layouts.app>
    <x-slot name="title">{{ $thread->title }}</x-slot>

    <x-slot name="rightSection">
        <div>test</div>
    </x-slot>

    <x-slot name="mainSection">
        <x-cards.thread :thread="$thread" />

        @if ($thread->replies->count())
            <div class="card text-dark mb-5">     
                @foreach ($thread->replies as $reply)
                    <x-cards.reply :reply="$reply" />

                    @if (! $loop->last)
                        <hr class="my-0" />
                    @endif
                @endforeach
            </div>
        @endif
          
    </x-slot>

    <x-slot name="leftSection">
        <div>test</div>
    </x-slot>

</x-layouts.app>