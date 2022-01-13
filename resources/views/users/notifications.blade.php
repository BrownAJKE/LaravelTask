@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">Notifications</div>

    <div class="card-body">
        <ul class="list-group">
            @foreach ($notifications as $notification)
                @if ($notification->type == 'App\Notifications\NewReplyAdded')
                    <li class="list-group-item">
                        A new reply has been added to your notice
                        <strong>{{ $notification->data['discussion']['title'] }}</strong>
                        <a href="{{ route('discussions.show', $notification->data['discussion']['slug'] ) }}" style="color: white" class="btn btn-sm btn-info float-end">View Dicussion</a>
                    </li>
                @endif

                @if ($notification->type == 'App\Notifications\NewNoticeAdded')
                    <li class="list-group-item">
                        A new notice <strong>{{ $notification->data['discussion']['title'] }}</strong> has been added
                        <a href="{{ route('discussions.show', $notification->data['discussion']['slug'] ) }}" style="color: white" class="btn btn-sm btn-info float-end">View Dicussion</a>
                    </li>
                @endif

                @if ($notification->type == 'App\Notifications\ApprovedNotice')
                    <li class="list-group-item">
                        Congratulations! Your notice <strong>{{ $notification->data['discussion']['title'] }}</strong> has been approved.
                        <a href="{{ route('discussions.show', $notification->data['discussion']['slug'] ) }}" style="color: white" class="btn btn-sm btn-info float-end">View Dicussion</a>
                    </li>
                @endif
            @endforeach
    </div>
</div>
@endsection
