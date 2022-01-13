<div class="align-items-center mt-5">
    <div class="">
        <div class="row  mb-4">
            <div class="col-lg-12">
                <h5>Replies</h5>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="comments">
                    @foreach ($discussion->replies()->latest()->paginate(3) as  $reply)
                        <div class="comment d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="avatar avatar-sm rounded-circle">
                                    <img class="avatar-img" src="{{ Gravatar::get($reply->owner->email) }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="flex-shrink-1 ms-2 ms-sm-3">
                                <div class="comment-meta d-flex">
                                    <h6 class="me-2">{{ $reply->owner->name }}</h6>
                                    <span class="text-muted">{{ $reply->created_at->diffForHumans() }}</span>
                                    
                                </div>
                                <div class="comment-body">
                                    {!! $reply->content !!}
                                </div>
                            </div>
                            <div class="class text-right ml-3">
                                @auth
                                    @if (auth()->user()->id == $reply->user_id)
                                        <button type="button" class="btn btn-danger btn-sm float-end"
                                             wire:click="deleteReply({{ $reply->id }})"><i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                    {{ $discussion->replies()->paginate(3)->links() }}
                </div>
            </div>
        </div>
        <div class="card row justify-content-center">
            <div class="card-header col-lg-12">
                @auth
                <div class="comment-form d-flex align-items-center mt-2">
                    <div class="flex-shrink-0">
                        <div class="avatar avatar-sm rounded-circle">
                            <img class="avatar-img"
                                src="{{ Gravatar::get(auth()->user()->email) }}"
                                alt="">
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-2 ms-sm-3">
                        <form wire:submit.prevent="addComment">
                            <textarea name="content" wire:model="content" class="@error('content') is-invalid @enderror form-control py-0 px-1 mb-2 border-0" rows="3" placeholder="Start writing..."
                                style="resize: none;"></textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <button type="submit" class="btn btn-warning btn-sm">Add Reply</button>
                        </form>
                    </div>
                </div>
                @else
                <div class="text-center">
                    <a href="{{ route('login') }}" class="btn btn-warning">Login to add a reply</a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>