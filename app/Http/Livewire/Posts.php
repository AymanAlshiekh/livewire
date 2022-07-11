<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Posts extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = Post::with(['user', 'category'])->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.posts', [
            'posts' => $posts,
        ]);
    }
    public function create_post(){
        return redirect()->to('/create/post');
    }
    public function edit_post($id){
        return redirect()->to('/edit/post/'.$id);
    }
    public function show_post($id){
        return redirect()->to('/show/post/'.$id);
    }
    public function delete_post($id){
        $post = Post::findOrFail($id);
        File::delete(public_path('/assets/images/'.$post->slug));
        $post->delete();
        session()->flash('message', 'post deleted successfully');
        return redirect()->to('/livewire/posts');
    }
}
