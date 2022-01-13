@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">
    
</div>
    @if ($discussions->count() > 0)
        @foreach ($discussions as $discussion)
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img style="border-radius: 50%" src="{{ Gravatar::fallback('')->get($discussion->author->email); }}" alt="" width="50">
                        <span class="ml-2"><strong>{{ $discussion->author->name }}</strong></span>
                    </div>
                    <div class="mt-2">
                    <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <strong>{{ $discussion->title }}</strong>
            </div>
        </div>
        @endforeach

        {{ $discussions->appends(['channel', request()->query('channel')])->links() }}
    @else
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text text-center">No discussions available now </p>
            </div>
        </div>
    @endif
    
@endsection
