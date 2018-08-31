<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class AdminMediaController extends Controller
{
    //

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        //
        $media = Photo::all();


        return view('admin.media.index', compact('media'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        //
        return view('admin.media.upload');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request) {
        if ($file = $request->file('file')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            Photo::create(['file' => $name]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id) {
        Photo::findOrFail($id)->delete();

        session()->flash('message', ['status' => 'warning', 'message' => 'Photo has been deleted!']);

        return redirect()->route('admin.media.index');
    }
}
