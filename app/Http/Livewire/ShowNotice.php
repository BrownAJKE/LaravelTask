<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use App\Notifications\NewReplyAdded;
use Livewire\Component;

class ShowNotice extends Component
{

    public $discussion;
    public $content;


    public function updated($field)
    {
        $this->validateOnly($field, [
            'content' => 'required|min:5'
        ]);
    }

    private function resetInputFields(){
        $this->content = '';
    }

    public function addComment()
    {
        $this->validate([
            'content' => 'required|min:5'
        ]);

        $reply = Reply::create([
            'content' => $this->content,
            'user_id' => auth()->user()->id,
            'discussion_id' => $this->discussion->id
        ]);

        if($this->discussion->author->id !== auth()->user()->id)
        {
            $this->discussion->author->notify(new NewReplyAdded($this->discussion));
        }

    }

    public function deleteReply($id)
    {
        $reply = Reply::findorFail($id);
        $reply->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Reply successfully deleted 😄.']);
    }


    public function render()
    {
        return view('livewire.show-notice');
    }
}
