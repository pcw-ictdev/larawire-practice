<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostIndex extends Component
{
    use WithPagination;
    public $showingPostModal = false;

    public $title;
    public $body;
    public $search = '';

    private $pagination = 5;

    public function showPostModal()
    {
        $this->showingPostModal = true;
    }

    public function storePost()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        
        $newPost = Post::create([
            'title' => $this->title,
            'post_detail_id' => 1,
            'body' => $this->body
        ]);

        $this->reset();
    }

    public function render()
    {
        $posts = Post::where('title', 'LIKE', '%'.$this->search.'%')->paginate($this->pagination);

        return view('livewire.post-index', compact('posts'));
    }
}
