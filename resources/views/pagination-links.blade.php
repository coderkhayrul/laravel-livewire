@if ($paginator->hasPages())
    <ul class="flex justify-between">
        <li style="cursor: pointer;" class="bg-blue-600 px-4 py-2 shadow border rounded text-white font-bold" wire:click="previousPage">Prev</li>
        <li style="cursor: pointer;" class="bg-blue-600 px-4 py-2 shadow border rounded text-white font-bold" wire:click="nextPage">Next</li>
    </ul>
@endif
