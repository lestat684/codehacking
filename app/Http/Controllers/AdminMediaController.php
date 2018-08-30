<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminMediaController extends Controller
{
    //

    public function index() {
        //
        $media = Photo::all();


        return view('admin.media.index', compact('media'));
    }
}
