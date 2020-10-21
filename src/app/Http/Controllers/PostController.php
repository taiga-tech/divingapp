<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $posts;

    public function __construct(Post $posts)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->posts = $posts;
    }

    public function index()
    {
        $posts = $this->posts->all()->sortByDesc('created_at');
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = $request->all();
        $post['user_id'] = Auth::id();
        $post = $this->posts->create($post);
        $timeStamp = date('Ymd-His');
        if ($request->file('files')) {
            foreach ($request->file('files') as $index=> $e) {
                $ext = $e['image']->guessExtension();
                $filename = "{$timeStamp}_{$index}.{$ext}";
                $path = $e['image']->storeAs('post/'.$post->id , $filename);
                $post->images()->create(['path'=> $path]);
            }
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->posts->find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->posts->find($id);
        if (Auth::id() === $post->user->id) {
            return view('posts.edit', compact("post"));
        } else {
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = $this->posts->find($id);
        $post->update($request->all());
        $timeStamp = date('Ymd-His');

        // 個別で画像編集できるようにする
        if ($request->file('files')) {
            foreach ($request->file('files') as $index=> $e) {
                $ext = $e['image']->guessExtension();
                $filename = "{$timeStamp}_{$index}.{$ext}";
                $path = $e['image']->storeAs('post/'.$post->id , $filename);
                $post->images()->create(['path'=> $path]);
            }
        }
        return redirect(route('posts.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->posts->find($id);
        if (Auth::id() === $post->user->id) {
            $post->delete();
        }
        return redirect('/');
    }

}
