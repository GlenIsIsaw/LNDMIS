<div class="card-header">
    <div class="fw-bolder fs-3 float-start text-uppercase">
        Create Individual Development Plan    
    </div>
</div>
<div class="card-body">
        @if ($next == 0)
            <form wire:submit.prevent="keep">
                @include('idp.part.part1')
            </form>
        @endif
        @if ($next == 1)

        
            @include('idp.part.part2')
            <hr class="h-color mx-2 mt-3">
            <button type="button" class="btn btn-secondary" wire:click="back" data-bs-dismiss="modal">Back</button>
            <div class="float-end">
            
            <button type="button" class="btn btn-danger" wire:click="backButton" data-bs-dismiss="modal">Close</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#createConfirmationIdpModal" class="btn btn-primary">Save</button>
        @endif
            </div>
</div>