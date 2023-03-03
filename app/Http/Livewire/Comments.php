<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class Comments extends Component
{
    public $newComment = '';
    public $comments;
//    Mount
    public function mount(){
        $newcomments = Comment::latest()->get();
        $this->comments = $newcomments;
    }

    public  function addComment(){

        $this->validate([
            'newComment' => 'required|min:3',
        ],
        [
            'newComment.required' => 'Comment is required',
            'newComment.min' => 'Comment must be at least 3 characters'
        ]);
        $newComment = $this->newComment;
        $createdComment = Comment::create([
            'body' => $newComment,
            'user_id' => 1,
        ]);
        $this->comments->prepend($createdComment);
        $this->newComment = '';
    }
    public function render()
    {
        return view('livewire.comments');
    }
}
