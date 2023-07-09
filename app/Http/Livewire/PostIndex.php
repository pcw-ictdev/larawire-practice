<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostIndex extends Component
{
    use WithPagination;
    public $showingPostModal = false;

    public $title, $body;
    public $search = '';
    public $name;
    public $isEditMode = false;
    public $post;
    
    private $pagination = 5;

    public function showPostModal()
    {
        $this->reset();
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

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Item successfully saved!',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function showEditPostModal($id)
    {
        $this->showingPostModal = true;
        $this->isEditMode = true;

        $this->post = Post::findOrFail($id);
        $this->title = $this->post->title;
        $this->body = $this->post->body;
    }

    public function updatePost()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $this->post->update([
            'title' => $this->title,
            'body' => $this->body,
        ]);

        $this->showingPostModal = false;

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Item successfully updated!',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }   

    public function mount()
    {
        $this->name = 'hello world sasa';


    }

    public function render()
    {
        $posts = Post::where('title', 'LIKE', '%'.$this->search.'%')->paginate($this->pagination);
        $postsCount = Post::where('title', 'LIKE', '%'.$this->search.'%')->count();

        if ($postsCount < 6) {
            $this->resetPage();
        }

        // $this->resetPage();

        return view('livewire.post-index', compact('posts', 'postsCount'));
    }
}
