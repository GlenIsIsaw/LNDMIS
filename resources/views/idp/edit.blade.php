<div class="card-header">
    <div class="fw-bolder fs-3 float-start text-uppercase">
        Edit Individual Development Plan    
    </div>
</div>
<div class="card-body">
    @if ($next == 0)
        <form wire:submit.prevent="next">
            @include('idp.part.part1')
        </form>
    @endif
    @if ($next == 1)
            @include('idp.part.part2')
            <button type="button" class="btn btn-secondary" wire:click="back"  wire:loading.attr="disabled" id="back">Back</button>

            <div class="float-end">
            
            <button type="button" data-bs-toggle="modal" data-bs-target="#editConfirmationIdpModal" class="btn btn-primary float-end"> <i class="fas fa-save me-2"></i>Save</button>
            <button type="button" class="btn btn-danger float-end" wire:click="backButton" data-bs-dismiss="modal">Close</button>
            </div>
    @endif
</div>