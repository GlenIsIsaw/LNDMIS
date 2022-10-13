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

            @include('idp.part.part2')
            <button type="button" class="btn btn-secondary" wire:click="backButton" data-bs-dismiss="modal">Close</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#createConfirmationIdpModal" class="btn btn-primary">Save</button>
        @endif
</div>