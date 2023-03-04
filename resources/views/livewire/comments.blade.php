<div>
    <div class="flex justify-center">
        <div class="w-6/12">
            @if (session()->has('message'))
                <div class="border mt-5 p-2 rounded bg-green-500 shadow text-white">
                    {{ session('message') }}
                </div>
            @endif
            <h1 class="my-10 text-3xl">Comments</h1>
            @error('newComment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                <section>
                    @if($image)
                        <img style="width: 100px;" class="rounded mb-3" src="{{ $image }}" alt="">
                    @endif
                    <input id="image" type="file" name="image" class="border shadow w-10/12 p-2" wire:change="$emit('fileChoosing')">
                </section>
                <form class="my-4 flex" wire:submit.prevent="addComment">
                <input wire:model.lazy="newComment" type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's in you mind ?">
                <div class="py-2">
                    <button class="p-2 bg-blue-600 w-20 rounded shadow text-white" type="submit">Add</button>
                </div>
            </form>
            @foreach($comments as $comment)
                <div class="rounded shadow border my-4 pb-3 pl-2">
                    <div class="flex justify-between my-2 items-center">
                        <div class="flex">
                            <h2 class="font-bold text-lg mr-2">{{ $comment->creator->name }}</h2>
                            <p class="text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                        <i class="fa-solid fa-trash text-white rounded shadow bg-red-700 p-2 mr-2" wire:click="removeComment({{$comment->id}})"></i>
                    </div>
                    <p>{{ $comment->body }}</p>
                </div>
            @endforeach
                {{ $comments->links('pagination-links') }}
        </div>
    </div>
</div>

<script>
    Livewire.on('fileChoosing', () => {
        let inputFile = document.getElementById('image');
        let file = inputFile.files[0]
        let reader = new FileReader();
        reader.onloadend = () => {
            Livewire.emit('fileUpload', reader.result);
        }
        reader.readAsDataURL(file);

    })
</script>
