<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        Comment::create([
            'body' => $data['body'],
            'commentable_id' => $data['commentable_id'],
            'commentable_type' => "App\Models\Post",
            'name' => $data['name'],
            'email' => $data['email']
        ]);

        return redirect()->route('posts.show', ['post' => $data['commentable_id']]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = Comment::find($id);
        return view('posts.editComment', ['oldcomment' => $comment]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $comment = Comment::find($id);
        $comment->body = $data['body'];
        $comment->name = $data['name'];
        $comment->email = $data['email'];
        $comment->save();
        return redirect()->route('posts.show', ['post' => $comment->commentable_id]);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('posts.show', ['post' => $comment->commentable_id]);
    }
}
