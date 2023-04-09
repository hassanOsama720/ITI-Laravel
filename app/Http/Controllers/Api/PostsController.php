<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$posts = Post::all();
        $posts = Post::with('user')->get();
        return $posts;






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
         $data =$request->all();
         $validatedData = $request->validate([
             'title' => 'required|max:255',
             'body' => 'required',
         ]);
            $post = Post::create([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'user_id' => auth()->user()->id
            ]);
            return $post;

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if (!$post){
            return response()->json([
                'id' => $id,
                'message' => 'Post not found'
            ], 404);
        }
        return new PostResource($post);
        //return $post;
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
