<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'post_id',
        'is_active',
        'author',
        'body'
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function replies()
    {
        return $this->hasMany('App\CommentReply');
    }

    public function getPhotoAttribute()
    {
        if ($user = User::where('name', $this->getAttribute('author'))->first()) {
            $photo = $user->photo;
        }

        return !empty($photo) ? $photo->file : 'http://placehold.it/64x64';
    }
}
