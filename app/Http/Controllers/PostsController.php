<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $posts = [
            1 => [
                'id' => '1',
                'title' => 'Intro to Laravel',
                'content' => 'This is a short intro to Laravel',
                'posted_by' => 'John Doe',
                'createdAt' => '2019-01-01 12:00:00'
            ],
            2 => [
                'id' => '2',
                'title' => 'Intro to PHP',
                'content' => 'This is a short intro to PHP',
                'posted_by' => 'John Doe',
                'createdAt' => '2019-01-01 12:00:00'
            ],
            3 => [
                'id' => '3',
                'title' => 'Intro to JavaScript',
                'content' => 'This is a short intro to JavaScript',
                'posted_by' => 'John Doe',
                'createdAt' => '2019-01-01 12:00:00'
            ],
        ];

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = [
            'id' => '1',
            'title' => 'Intro to Laravel',
            'content' => 'This is a short intro to Laravel',
            'posted_by' => 'John Doe',
            'createdAt' => '2019-01-01 12:00:00'
        ];
        return view('posts.show', ['post' => $post]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = [
            'id' => '1',
            'title' => 'Intro to Laravel',
            'content' => 'This is a short intro to Laravel',
            'posted_by' => 'John Doe',
            'createdAt' => '2019-01-01 12:00:00'
        ];
        return view('posts.edit', ['oldpost' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('posts.show', ['post' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
