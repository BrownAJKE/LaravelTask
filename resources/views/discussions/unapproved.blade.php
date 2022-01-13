@extends('layouts.app')

@section('content')


    <div class="card">
        <div class="card-header">Unapproved Notices</div>

        <div class="card-body">
            <ul class="list-group">
                @foreach ($discussions as $discussion)
                    <li class="list-group-item">
                        {{ $discussion->title }}

                        <a href="{{ route('discussions.show', $discussion->slug) }}"
                            style="color: white" class="btn btn-sm btn-info float-end text-white">View</a>
                    </li>
                @endforeach
        </div>
    </div>
@endsection
