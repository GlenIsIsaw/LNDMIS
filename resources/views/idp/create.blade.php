<div class="card-header">
    <h4>
        Create Individual Development Plan    
    </h4>
</div>
<div class="card-body">
        @if ($next == 0)
            <form wire:submit.prevent="keep">
                @include('idp.part.part1')
            </form>
        @endif
        @if ($next == 1)
            <form wire:submit.prevent="store">
                @include('idp.part.part2')
            </form>
        @endif
</div>