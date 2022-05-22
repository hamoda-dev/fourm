<x-layouts.app>
    <x-slot name="title">News</x-slot>

    <x-slot name="rightSection">
        <div>test</div>
    </x-slot>

    <x-slot name="mainSection">
        @forelse ($threads as $thread)
            <x-cards.thread :thread="$thread" />
        @empty
            
        @endforelse
    </x-slot>

    <x-slot name="leftSection">
        <div>test</div>
    </x-slot>
    
</x-layouts.app>