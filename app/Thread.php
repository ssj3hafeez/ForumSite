<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];
    
    public function path()

    {
        return "/threads/{$this->catergories->slug}/{$this->id}";
    }
    

    public function replies()

    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsto(User::class, 'user_id');
    }


    public function catergories()
    {

        return $this->belongsTo(Catergories::class);



    }

    public function addReply($reply)
    {

        $this->replies()->create($reply);

    }





}
