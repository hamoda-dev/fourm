@props(['reply'])

<div class="card-body p-4">
    <div class="d-flex flex-start">
        <img class="rounded-circle shadow-1-strong me-3"
        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(26).webp" alt="avatar" width="60"
        height="60" />
        <div>
        <h6 class="fw-bold mb-1">{{ $reply->owner->name }}</h6>
        <div class="d-flex align-items-center mb-3">
            <p class="mb-0">Posted at {{ $reply->created_at->diffForHumans() }}</p>
        </div>
        <p class="mb-0">
            {{ $reply->body }}
        </p>
        </div>
    </div>
</div>