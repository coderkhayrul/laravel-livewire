@if ($paginator->hasPages())
    <ul class="flex justify-between">
        <!-- Previous Page -->
        @if ($paginator->onFirstPage())
            <li class="bg-gray-500 px-4 py-1.5 border rounded text-gray-100 font-bold">Prev</li>
        @else
            <li class="cursor-pointer bg-blue-600 px-4 py-1.5 shadow border rounded text-white font-bold" wire:click="previousPage">Prev</li>
        @endif
        <!-- Previous Page End -->
        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <div class="flex">
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li wire:click="gotoPage({{$page}})" class="cursor-pointer bg-white px-4 py-1.5 shadow border rounded text-blue-600 font-bold mx-1">{{ $page }}</li>
                            @else
                                <li wire:click="gotoPage({{$page}})" class="cursor-pointer bg-blue-600 px-4 py-1.5 shadow border rounded text-white font-bold mx-1">{{ $page }}</li>
                            @endif
                    @endforeach
                @endif
            </div>
        @endforeach

        <!-- Next Page -->
        @if ($paginator->hasMorePages())
            <li class="cursor-pointer bg-blue-600 px-4 py-1.5 shadow border rounded text-white font-bold" wire:click="nextPage">Next</li>
        @else
            <li class="bg-gray-500 px-4 py-1.5 border rounded text-gray-100 font-bold" >Next</li>
        @endif
        <!-- Next Page End -->
    </ul>
@endif
