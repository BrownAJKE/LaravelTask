@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <img style="border-radius: 50%" src="{{ Gravatar::fallback('')->get($discussion->author->email) }}"
                        alt="" width="50">
                    <span class="ml-2"><strong>{{ $discussion->author->name }}</strong></span>
                </div>
                @auth
                @if (Auth::user()->isAdmin())
                    <div class="mt-2">
                        <form action="{{ route('approve-notice', $discussion->slug) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn {{ $discussion->status == false  ? 'btn-success' : 'btn-danger'  }} btn-sm">{{ $discussion->status == false  ? 'Approve' : 'Disapprove'  }}</button>
                        </form>
                    </div>
                @endif
                @endauth
            </div>
        </div>

        <div class="card-body">
            <strong>{{ $discussion->title }}</strong>
            <hr>
            {!! $discussion->content !!}
        </div>
    </div>

    <livewire:show-notice :discussion="$discussion">


@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" />
    <link rel="stylesheet" href="{{ asset('css/reply.css') }}">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection
