<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['file'];

    protected $upload_dir = '/images';

    public function getFileAttribute($photo) {
        return file_exists(public_path() . DIRECTORY_SEPARATOR . "{$this->upload_dir}/$photo") ? "{$this->upload_dir}/$photo" : "{$this->upload_dir}/400x400.png";
    }
}
