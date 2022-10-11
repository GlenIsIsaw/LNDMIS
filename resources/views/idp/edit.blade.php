<div class="card-header">
    <h4>
        Edit Individual Development Plan    
    </h4>
</div>
<div class="card-body">
    @if ($next == 0)
        <form wire:submit.prevent="next">
            @include('idp.part.part1')
        </form>
    @endif
    @if ($next == 1)
        <form wire:submit.prevent="update">
            @include('idp.part.part2')
        </form>
    @endif
</div>