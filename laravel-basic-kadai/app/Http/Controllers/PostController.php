<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        $posts = DB::table('posts')->get();
        return view('posts.index', compact('posts'));
    }

    public function show($id) {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:20',
            'content' => 'required|max:200'
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        $posts = Post::all();

        return view('posts.index', compact('posts', 'post'));
    }
}
