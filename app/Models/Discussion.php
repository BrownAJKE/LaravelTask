<?php

namespace App\Models;
use App\Models\User;
use App\Models\Reply;
use App\Models\Channel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;
    protected $guarded = [];
    

    public function author()
    {
       return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function approveDiscussion(Discussion $discussion)
    {
        $this->update([
            'status' => true
        ]);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilterByChannels($builder)
    {
        if(request()->query('channel'))
        {
            //filter
            $channel = Channel::where('slug', request()->query('channel'))->first();

            if($channel)
            {
                return $builder->where('channel_id', $channel->id);
            }
        }
        else{
            return $builder;
        }
    }


}
