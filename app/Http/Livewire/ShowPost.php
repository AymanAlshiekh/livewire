<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public $post;

    public function render()
    {
        $this->post = Post::with(['user', 'category'])->findOrFail(request()->id);
        return view('livewire.show-post');
    }
    public function back_to_post()
    {
        return redirect()->to('/livewire/posts');
    }
}
