<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts()->orderBy('updated_at', 'asc')->get();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {   
        /*バリデーション*/
        Post::create([
            'title' => $request->validated()['title'],
            'content' => $request->validates()['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('posts.index')->with('flash_message', '投稿が完了しました。');
    }

    public function edit(Post $post)
    {
        if($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        if($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        /*バリデーション*/
        $post->update($request->validated());

        return redirect()->route('posts.show',$post)->with('flash_message', '投稿を編集しました。');
    }

    public function destroy(Post $post) {
        if($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error?message', '不正なアクセスです。');
        }

        $post->delete();
        return redirect()->route('posts.index')->with('flash_message', '投稿を削除しました。');
    }
}
