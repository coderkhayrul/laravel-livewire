<div>
    <h2 class="font-bold text-3xl">Support Tickets</h2>

    <ul>
        @foreach($tickets as $ticket)
            <li class="border shadow p-2 m-2 text-1xl {{ $ticket->id == $active ? 'bg-blue-500 text-white' : ''}}"
            wire:click="$emit('ticketSelected', {{ $ticket->id }})"
            >{{$ticket->question}}</li>
        @endforeach
    </ul>
</div>
