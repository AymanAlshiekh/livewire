<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class DaynamicEdit extends Component
{
    use WithFileUploads;
    public $post_id, $post, $title, $body, $category_id, $image, $imageOriginal;

    protected $listeners = ['getPost' => 'getPost'];
    public function mount()
    {
        // $this->post = Post::findOrFail($this->post_id);
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.daynamic-edit', [
            'categories'    => $categories,
            'post'    => $this->post,
        ]);
    }
    public function getPost($post)
    {
        $this->post = $post;
        $this->post_id = $this->post['id'];
        $this->title = $this->post['title'];
        $this->body = $this->post['body'];
        $this->category_id = $this->post['category_id'];
        $this->image = $this->post['image'];
        $this->imageOriginal = $this->post['image'];
    }
    public function save()
    {
        $this->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|integer',
            'body'          => 'required|string',
            'image'         =>  'nullable|image|max:5000|mimes:png,jpg,jpeg',
        ]);
        $post = Post::findOrFail($this->post_id);
        $data['user_id'] = auth()->id();
        $data['title'] = $this->title;
        $data['body'] = $this->body;
        $data['category_id'] = $this->category_id;
        if ($this->image) {
            File::delete(public_path('/assets/images/'.$this->post['slug']));
            $path = public_path('/assets/images/'.$this->post['slug']);
            Image::make($this->image->getRealPath())->save($path, 100);
        }
        $post->update($data);
        $this->emit('postUpdated', $post);
    }
}
