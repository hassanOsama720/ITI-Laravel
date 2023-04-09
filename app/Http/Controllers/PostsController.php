<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // pagination with 10 posts per page newest first



        // posts with pagination
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$users = User::all();
        $user = Auth::user();
        return view('posts.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:11',
            'user_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // image upload
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(storage_path('app/public/images/posts'), $imageName);

        Post::create([
           'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => $data['user_id'],
            'image' => $imageName
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // find by slug
        //$post = Post::where('slug', $id)->firstOrFail();
        $post = Post::find($id);
        if (!$post){
            return redirect()->route('posts.index');
        }
        return view('posts.show', ['post' => $post]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        return view('posts.edit', ['oldpost' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:11',

        ]);
        if (isset($data['image'])) {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if (Storage::exists("public/images/posts/{$data['image']}")) {
                Storage::delete("public/images/posts/{$data['image']}");
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(storage_path('app/public/images/posts'), $imageName);
        }



        $post = Post::find($id);
        $post->title = $data['title'];
        $post->content = $data['content'];
        if (isset($imageName))
            $post->image = $imageName;
        $post->save();

        return redirect()->route('posts.show', ['post' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if (Storage::exists("public/images/posts/{$post['image']}")) {
            Storage::delete("public/images/posts/{$post['image']}");
        }
        $post->delete();

        return redirect()->route('posts.index');

    }
}
