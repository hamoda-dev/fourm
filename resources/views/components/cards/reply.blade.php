@props(['reply'])

<div class="card-body p-4">
    <div class="d-flex flex-start">
        <img class="rounded-circle shadow-1-strong me-3"
        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(26).webp" alt="avatar" width="60"
        height="60" />
        <div>
        <h6 class="fw-bold mb-1">{{ $reply->owner->name }}</h6>

        <div class="d-flex align-items-center mb-3">
            <p class="mb-0 mr-5">
                Posted at {{ $reply->created_at->diffForHumans() }}
            </p>
            <div class="ms-2">
                <form method="POST" action="{{ route('favorites.reply', $reply) }}">
                    @csrf

                    <button type="submit" class="btn btn-danger btn-sm" @disabled($reply->isFavorited())>
                        {{ $reply->favorites_count }} <i class="fas fa-heart ms-2"></i>
                    </button>
                </form>
                {{-- <a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
            <a href="#!" class="text-success"><i class="fas fa-redo-alt ms-2"></i></a> --}}
            </div>
            
            
        </div>
        <p class="mb-0">
            {{ $reply->body }}
        </p>
        </div>
    </div>
</div>