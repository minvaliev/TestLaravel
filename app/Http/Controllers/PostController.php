<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{
    public function index() {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create() {
        return view('post.create');
    }

    public function store() {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);

        Post::create($data);
        return redirect()->route('post.index');
    }

    public function show(Post $post) {
//        $post = Post::findOrFail($post);
        return view('post.show', compact('post'));
    }

    public function edit(Post $post) {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post) {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);

        $post->update($data);
        return redirect()->route('post.show', $post->id);
    }

    public function delete() {
        $post = Post::withoutTrashed()->find(2);
        $post->resrore();
        dd('deleted');

    }
    public function destroy(Post $post) {
        $post->delete();
        return redirect()->route('post.index');
    }

    //firstOrCreate
    //updateOrCreate

    public function firstOrCreate() {
        $anotherPost = [
            'title' => 'some post',
            'content' => 'content text another',
            'is_published' => 0,
            'image' => 'image text another',
            'likes' => 15
        ];

        $post = Post::firstOrCreate(
        [
            'title' => 'title text 2',
        ],
        [
            'title' => 'some post',
            'content' => 'content text another',
            'is_published' => 0,
            'image' => 'image text another',
            'likes' => 15
        ]);

        dump($post);

        dd('finished');
    }

    public function updateOrCreate() {
        $anotherPost = [
            'title' => 'some post updateOrCreate',
            'content' => 'content text another updateOrCreate',
            'is_published' => 0,
            'image' => 'image text another updateOrCreate',
            'likes' => 5
        ];

        $post = Post::updateOrCreate(
        [
            'title' => 'some post',
        ],
        [
            'title' => 'some post updateOrCreate',
            'content' => 'content text another updateOrCreate',
            'is_published' => 0,
            'image' => 'image text another updateOrCreate',
            'likes' => 5
        ]);

        dump($post->content);

        dd(777);
    }
}
