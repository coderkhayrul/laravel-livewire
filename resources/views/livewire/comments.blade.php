<div>
    <div class="flex justify-center">
        <div class="w-6/12">
            <h1 class="my-10 text-3xl">Comments</h1>
            <form class="my-4 flex" wire:submit.prevent="addComment">
                <input wire:model.lazy="newComment" type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's in you mind ?">
                <div class="py-2">
                    <button class="p-2 bg-blue-600 w-20 rounded shadow text-white" type="submit">Add</button>
                </div>
            </form>
            @foreach($comments as $comment)
            <div class="rounded border shadow p-3 my-2">
                <div class="flex justify-start my-2">
                    <p class="font-bold text-lg">{{ $comment->creator->name }}</p>
                    <p class="text-gray-500 text-sm ml-2">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
                <p class="text-gray-600">{{ $comment->body }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
