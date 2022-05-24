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

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Add a title">
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">What's on your mind?</label>
                        <textarea class="form-control" name="body" id="body" rows="6" placeholder="What's on your mind?"></textarea>
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