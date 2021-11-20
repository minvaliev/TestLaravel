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
        $rew = 777;
        $posts = Post::all();
        return view('posts', compact('posts'));
    }

    public function create() {
        $postsArr = [
            [
                'title' => 'title text',
                'content' => 'content text',
                'is_published' => 1,
                'image' => 'image text',
                'likes' => 50
            ],
            [
                'title' => 'title text another',
                'content' => 'content text another',
                'is_published' => 0,
                'image' => 'image text another',
                'likes' => 15
            ],
        ];

       foreach ($postsArr as $item) {
           Post::create($item);
       }

        dd('created');
    }

    public function update() {
        $post = Post::find(6);

        $post->update([
            'title' => 'title text another update222',
            'content' => 'content text another update777',
        ]);

        dd('updated');
    }

    public function delete() {
        $post = Post::withoutTrashed()->find(2);
        $post->resrore();
        dd('deleted');
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
