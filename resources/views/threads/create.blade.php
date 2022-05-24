<x-layouts.app>
    <x-slot name="title">Create threads</x-slot>

    <x-slot name="rightSection">
        <div>test</div>
    </x-slot>

    <x-slot name="mainSection">
        <h1 class="mb-4">Create New Thread</h1>
        <div class="card">
            <div class="card-body">
                
                <form method="POST" action="{{ route('threads.store') }}">
                    @csrf

                    <div class="mb-2">
                        <label for="channel_id" class="form-label">Channel</label>
                        <select name="channel_id" id="channel_id" class="form-select" aria-label="channel select menu">
                            <option value="" selected>Choose channel</option>
                            @foreach ($channels as $channel)
                                <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                            @endforeach
                        </select>

                        @error('channel_id')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-2">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Add a title">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="body" class="form-label">What's on your mind?</label>
                        <textarea class="form-control" name="body" id="body" rows="6" placeholder="What's on your mind?"></textarea>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
            </div>
        </div>
    </x-slot>

    <x-slot name="leftSection">
        <div>test</div>
    </x-slot>
    
</x-layouts.app>