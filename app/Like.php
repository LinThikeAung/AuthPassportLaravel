<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id','feed_id'];


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function feed(){
        return $this->belongsTo(Feed::class,'feed_id');
    }
}
