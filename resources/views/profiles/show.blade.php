<x-layouts.app>
    <x-slot name="title">{{ $profileUser->name }}</x-slot>

    <x-slot name="rightSection">
        <div>test</div>
    </x-slot>

    <x-slot name="mainSection">
        <div class="page-header mb-5">
            <h1>{{ $profileUser->name }}</h1>
        </div>

        @forelse ($threads as $thread)
            <x-cards.thread :thread="$thread" />
        @empty
            
        @endforelse
    </x-slot>

    <x-slot name="leftSection">
        <div>test</div>
    </x-slot>

</x-layouts.app>