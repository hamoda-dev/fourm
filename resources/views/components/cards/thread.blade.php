@props(['thread'])

<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex flex-start align-items-center">
            <img class="rounded-circle shadow-1-strong me-3"
                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="60"
                height="60" />
            <div>
                <h6 class="fw-bold text-primary mb-1">
                    <a class="text-decoration-none" href="{{ route('profiles.show', $thread->owner->username) }}">
                        {{ $thread->owner->name }}
                    </a>
                </h6>
                <p class="text-muted small mb-0">
                Posted at {{ $thread->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
        <a  class="text-decoration-none" href="{{ $thread->path() }}">
            <h2 class="mt-3">{{ $thread->title }}</h2>
        </a>
        <p class="mt-3 mb-4 pb-2">
            {{ $thread->body }}
        </p>
    </div>
</div>