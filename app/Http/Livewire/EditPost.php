<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class EditPost extends Component
{
    use WithFileUploads;
    public $post, $title, $category_id, $body, $image;

    public function mount()
    {
        $this->post = Post::whereUserId(auth()->id())->findOrFail(request()->id);
        $this->title = $this->post->title;
        $this->body = $this->post->body;
        $this->image = $this->post->image;
        $this->category_id = $this->post->category_id;
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.edit-post', [
            'categories'    => $categories,
        ]);
    }
    public function save()
    {
        $this->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|integer',
            'body'          => 'required|string',
            'image'         =>  'nullable|image|max:5000|mimes:png,jpg,jpeg',
        ]);
        $data['user_id'] = auth()->id();
        $data['title'] = $this->title;
        $data['body'] = $this->body;
        $data['category_id'] = $this->category_id;
        if ($this->image) {
            File::delete(public_path('/assets/images/'.$this->post->slug));
            $path = public_path('/assets/images/'.$this->post->slug);
            Image::make($this->image->getRealPath())->save($path, 100);
        }
        $this->post->update($data);
        session()->flash('message', 'post updated successfully');
        return redirect()->to('/livewire/posts');
    }
    public function back_to_post()
    {
        return redirect()->to('/livewire/posts');
    }
}
