<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    //
    protected $fillable = [
        'comment_id',
        'is_active',
        'author',
        'body'
    ];

    public function comment() {
        return $this->belongsTo('App\Comment');
    }

    public function getPhotoAttribute() {
        $photo = (User::where('name', $this->getAttribute('author'))->first())->photo;
        return $photo ? $photo->file : '';
    }
}
