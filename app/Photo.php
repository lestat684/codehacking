<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['file'];

    protected $upload_dir = '/images';

    public function getFileAttribute($photo) {
        return "{$this->upload_dir}/$photo";
    }
}
