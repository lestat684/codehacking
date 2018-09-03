<?php

namespace App\Http\Controllers;

use App\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepliesController extends Controller
{
    public function create(Request $request, $id) {
        $user = Auth::user();

        $data = [
            'comment_id' => $id,
            'author' => $user->getAttribute('name'),
            'email' => $user->getAttribute('email'),
            'body' => $request->get('body'),
        ];

        CommentReply::create($data);

        $request->session()->flash('message', [
            'status' => 'success',
            'message' => "Your message was successfully send and waiting moderation!"
        ]);

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $replies = CommentReply::all();

        return view('admin.comments.replies.index', compact('replies'));
    }

    public function show($id) {
        //
        $replies = CommentReply::where('comment_id', $id)->get();

        return view('admin.comments.replies.index', compact('replies'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id) {
        CommentReply::findOrFail($id)->update(['is_active' => $request->is_active]);

        return redirect()->back();
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete($id) {
        if (CommentReply::findOrFail($id)->delete()) {
            $message = [
                'status' => 'success',
                'message' => "Message was successfully deleted!"
            ];
        }
        else {
            $message = [
                'status' => 'danger',
                'message' => "Something went wrong!"
            ];
        }

        return redirect()->back()->with('message', $message);
    }
}
