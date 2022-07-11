<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DaynamicShow extends Component
{
    public $post, $title, $body, $image, $category_id, $category_name, $user_id, $user_name;
    protected $listeners = [
        'showPost' => 'showPost',
    ];
    public function render()
    {
        return view('livewire.daynamic-show');
    }
    public function showPost($post){
        $this->post = $post;
        $this->title = $this->post['title'];
        $this->body = $this->post['body'];
        $this->user_id = $this->post['user_id'];
        $this->user_name = $this->post['user']['name'];
        $this->image = $this->post['image'];
        $this->category_id = $this->post['category_id'];
        $this->category_name = $this->post['category']['name'];
    }
}
