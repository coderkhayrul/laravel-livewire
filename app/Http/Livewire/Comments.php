<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithFileUploads;
    public $newComment;
    public $image;
    protected $listeners = ['fileUpload' => 'handelFileUpload'];
    public function handelFileUpload($imageData){
        $this->image = $imageData;
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
            'user_id' => User::inRandomOrder()->first()->id
        ]);
        $this->newComment = '';
        session()->flash('message', 'Comment successfully added.');
    }
    public function removeComment($id){
        $comment = Comment::find($id);
        $comment->delete();
//        $this->comments = $this->comments->where('id', '!=', $id);
//        $this->comments = $this->comments->except($id);
        session()->flash('message', 'Comment successfully Delete.');
    }
    use WithPagination;
    public function render()
    {
        return view('livewire.comments',[
            'comments' => Comment::latest()->paginate(3)
        ]);
    }
}
