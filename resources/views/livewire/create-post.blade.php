<div class="card">
    <div class="card-header">{{ __('Add Discussion') }}</div>

    <div class="card-body">
        <form wire:submit.prevent="addNotice"> 
            <div class="mb-3 form-group">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" wire:model="title" name="title" class="form-control @error('title') is-invalid @enderror" name="title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            {{-- <div class="mb-3" wire:model="content" wire:ignore>
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <input id="content" type="hidden" name="content">
                <trix-editor input="content"></trix-editor>
                <p>This is a test</p>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}
            <div class="mb-3" wire:model.debounce.365ms="content" wire:ignore>
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <input id="body" value="" type="hidden" name="content">
                <trix-editor input="body"></trix-editor>
            </div>


            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Channel</label>
                <select name="channel" wire:model="channel" id="channel" class="form-select form-select mb-3" aria-label=".form-select-lg example">
                    <option>Select channel</option>
                    @foreach ($channels as $channel)
                        <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                    @endforeach
                </select>
                @error('channel')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Create Discussion</button>
        </form>
    </div>
</div>