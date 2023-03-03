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

    public function updated($property)
    {
        $this->validateOnly($property, [
            'newComment' => 'required|min:3|max:255',
        ],
        [
            'newComment.required' => 'Comment is required',
            'newComment.min' => 'Comment must be at least 3 characters',
            'newComment.max' => 'Comment must be at maximum 255 characters'
        ]);
    }

    public  function addComment(){

        $this->validate([
            'newComment' => 'required|min:3|max:255',
        ],
        [
            'newComment.required' => 'Comment is required',
            'newComment.min' => 'Comment must be at least 3 characters',
            'newComment.max' => 'Comment must be at maximum 255 characters'
        ]);

        $newComment = $this->newComment;
        $createdComment = Comment::create([
            'body' => $newComment,
            'user_id' => 1,
        ]);
        $this->comments->prepend($createdComment);
        $this->newComment = '';
    }
    public function removeComment($id){
        $comment = Comment::find($id);
        $comment->delete();
        $this->comments = $this->comments->where('id', '!=', $id);
//        $this->comments = $this->comments->except($id);
    }
    public function render()
    {
        return view('livewire.comments');
    }
}
