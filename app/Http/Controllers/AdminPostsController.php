<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Photo;
use App\Post;
use App\User;
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
            $file->move('images/', $name);
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

        $post = Post::findOrFail($id);
        $categories = Category::lists('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AdminPostsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminPostsRequest $request, $id)
    {
        //
        $inputs = $request->all();
        $post = Post::findOrFail($id);

        if($file = $request->file('photo_id')) {
            // Create new.
            $name = Carbon::now()->timestamp . $file->getClientOriginalName();
            $file->move('images/', $name);
            $photo = Photo::create(['file' => $name]);
            $inputs['photo_id'] = $photo->id;
        }

        if ($post->update($inputs)) {
            return redirect()->route('admin.posts.index');
        }

        return back()->with('message', ['status' => 'danger', 'message' => "Something went wrong!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        unlink(public_path() . DIRECTORY_SEPARATOR . $post->photo->file);
        Photo::find($post->photo->id)->delete();
        $post->delete();

        return redirect()->route('admin.posts.index');
    }

    public function post($id) {
        $post = Post::findOrFail($id);
        $comments_data = [];
        $categories = Category::select('name')->get();
        foreach($post->comments as $comment) {
            $comments_data[$comment->id] = [
                'body' => $comment->body,
                'created_at' => $comment->created_at->diffForHumans(),
                'author' => $comment->author,
                'status' => $comment->is_active,
                'photo' => (User::where('name', $comment->author)->first())->photo->file
            ];
        }

        return view('post', compact('post', 'categories', 'comments_data'));
    }
}
