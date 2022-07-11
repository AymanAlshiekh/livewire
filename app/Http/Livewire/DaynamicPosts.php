<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class DaynamicPosts extends Component
{
    use WithPagination;
    protected $listeners = [
        'postAdded'         => 'postAdded',
        'postUpdated'       => 'postUpdated',
        'postDeleted'       => 'postDeleted',
        'showPost'          => 'showPost',
    ];
    public $showCreateForm = false, $showEditForm = false, $showPost = false;
    public function render()
    {
        $posts = Post::with(['user', 'category'])->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.daynamic-posts', [
            'posts'         => $posts,
        ]);
    }
    public function create_post(){
        $this->showCreateForm = !$this->showCreateForm;
        $this->showEditForm = false;
    }
    public function edit_post($id){
        $post = Post::findOrFail($id);
        $this->emit('getPost', $post);
        $this->showEditForm = !$this->showEditForm;
        $this->showCreateForm = false;
    }
    public function show_post($id){
        $post = Post::with(['user', 'category'])->findOrFail($id);
        $this->emit('showPost', $post);
        $this->showPost = !$this->showPost;
        $this->showCreateForm = false;
        $this->showEditForm = false;
    }
    public function delete_post($id){
        $post = Post::findOrFail($id);
        File::delete(public_path('/assets/images/'.$post->slug));
        $post->delete();
        $this->emit('postDeleted');
    }
    public function postAdded($post){
        session()->flash('message', 'post added successfully');
        $this->showCreateForm = false;
        $this->showEditForm = false;
    }
    public function postUpdated($post){
        session()->flash('message', 'post updated successfully');
        $this->showCreateForm = false;
        $this->showEditForm = false;
    }
    public function postDeleted(){
        session()->flash('message', 'post deleted successfully');
        $this->showCreateForm = false;
        $this->showEditForm = false;
    }
    public function showPost(){
        session()->flash('message', 'show post');
    }
}
