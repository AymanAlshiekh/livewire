<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class PostsController extends Controller
{

    public function __constract()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['user', 'category'])->orderBy('id', 'desc')->paginate(5);
        return view('frontend.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('frontend.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        $data = $request->validated();
        $path = public_path('/assets/images/'.$data['slug']);
        Image::make($request->file('image')->getRealPath())->save($path, 100);
        $data['image'] = $data['slug'];
        Auth::user()->posts()->create($data);
        return redirect()->route('posts.index')->with([
            'message' => 'post created successfully',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with(['user', 'category'])->findOrFail($id);
        return view('frontend.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('frontend.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request, $id)
    {
        $data = $request->validated();
        $post = Post::findOrFail($id);
        if ($request->file('image')) {
            File::delete(public_path('/assets/images/'.$post->slug));
            $path = public_path('/assets/images/'.$post->slug);
            Image::make($request->file('image')->getRealPath())->save($path, 100);
            $data['image'] = $post->slug;
        }
        $post->update($data);
        return redirect()->route('posts.index')->with([
            'message' => 'post updated successfully',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        File::delete(public_path('/assets/images/'.$post->slug));
        $post->delete();
        return redirect()->route('posts.index')->with([
            'message' => 'post deleted successfully',
            'alert-type' => 'success',
        ]);
    }
    public function index_livewire()
    {
        return view('frontend.index-livewire');
    }
}
