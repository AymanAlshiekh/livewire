<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

class DaynamicCreate extends Component
{
    use WithFileUploads;
    public $title, $category_id, $body, $image;
    public function render()
    {
        $categories = Category::all();
        return view('livewire.daynamic-create', [
            'categories'    => $categories,
        ]);
    }
    public function save()
    {
        $this->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|integer',
            'body'          => 'required|string',
            'image'         =>  'required|image|max:5000|mimes:png,jpg,jpeg',
        ]);
        $data['user_id'] = auth()->id();
        $data['title'] = $this->title;
        $data['body'] = $this->body;
        $data['category_id'] = $this->category_id;
        $data['slug'] = Str::slug($this->title).time();
        $path = public_path('/assets/images/'.$data['slug']);
        Image::make($this->image->getRealPath())->save($path, 100);
        $data['image'] = $data['slug'];
        $post = Post::create($data);
        $this->reset_form();
        $this->emit('postAdded', $post);
    }
    private function reset_form(){
        $this->title = null;
        $this->body = null;
        $this->image = null;
        $this->category_id = null;
    }
}
