<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $newComment;
    public $image;
    public $ticketId;
    protected $listeners = [
        'fileUpload' => 'handelFileUpload',
        'ticketSelected',
    ];

    public function ticketSelected($ticketId){
        $this->ticketId = $ticketId;
    }

    public function handelFileUpload($imageData){
        $this->image = $imageData;
    }
    public function updated($data)
    {
        $this->validateOnly($data, [
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
        // STORE IMAGE
        $image = $this->storeImage();
        $createdComment = Comment::create([
            'body' => $newComment,
            'image' => $image,
            'user_id' => User::inRandomOrder()->first()->id,
            'support_ticket_id' => $this->ticketId,
        ]);
        $this->newComment = '';
        $this->image = '';
        session()->flash('message', 'Comment successfully added.');
    }
    public function storeImage(){
        if (!$this->image)
        {
            return null;
        }
        $imageName = uniqid();
        $img = Image::make($this->image)->encode('jpg')->save('image/'.$imageName.'.jpg');
//        >save('media/setting/' . $image_name);
//        Storage::put('public/image.jpg', $img);
    }
    public function removeComment($id){
        $comment = Comment::find($id);
        $comment->delete();
//        $this->comments = $this->comments->where('id', '!=', $id);
//        $this->comments = $this->comments->except($id);
        session()->flash('message', 'Comment successfully Delete.');
    }
    public function render()
    {
        return view('livewire.comments',[
            'comments' => Comment::where('support_ticket_id', $this->ticketId)->latest()->paginate(3)
        ]);
    }
}
