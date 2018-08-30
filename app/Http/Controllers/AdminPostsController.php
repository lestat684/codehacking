<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\AdminPostsRequest;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        /**
         * @var $categories \App\Category.
         */
        $categories = Category::lists('name', 'id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|
     */
    public function store(AdminPostsRequest $request)
    {
        //
        $inputs = $request->all();

        $user = Auth::user();

        if($file = $request->file('photo_id')) {
            $name = Carbon::now() . $file->getClientOriginalName();
            $file->move('images/posts', $name);
            $photo = Photo::create(['file' => $name]);
            $inputs['photo_id'] = $photo->id;
        }

        if ($user->posts()->create($inputs)) {
            return redirect()->route('admin.posts.index');
        }

        return back()->with('message', 'Something went wrong!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        return view('admin.posts.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
