<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $fillable = ['user_id','description','image'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function comment(){
        return $this->hasMany(Comment::class,'feed_id');
    }
    public function like(){
        return $this->hasMany(Like::class,'feed_id');
    }
}
