<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\Discussion;
use App\Models\User;
use App\Notifications\NewNoticeAdded;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Illuminate\Support\Str;

class CreatePost extends Component
{
    public $title;
    public $content;
    public $channel;

    // Real time validation
    public function updated($field)
    {
        $this->validateOnly($field, [
            'title' => 'required|min:5',
            'content' => 'required',
            'channel' => 'required',
        ]);
    }

    private function resetInputFields(){
        $this->title = '';
        $this->content = '';
        $this->channel = '';
    }

    public function addNotice()
    {
        $this->validate([
            'title' => 'required|min:5',
            'content' => 'required',
            'channel' => 'required',
        ]);

        $discussion = Discussion::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'channel_id' => $this->channel,
            'user_id' => Auth::user()->id
        ]);

        //Send notification to admin users
        $users = User::where('is_admin', '=', true)->get();

        if($users){
            
            Notification::send($users, new NewNoticeAdded($discussion));
        }

        $this->emit('alert', ['type' => 'success', 'message' => 'Notice successfully added 😄.']);

        session()->flash('success', 'Notice successfully added 😄.');
        $this->resetInputFields();
    }


    public function render()
    {
        return view('livewire.create-post');
    }
}
