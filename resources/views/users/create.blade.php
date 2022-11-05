<div class="card-header">
    <div class="fw-bold fs-5 text-uppercase">
        Add New User    
    </div>
</div>
<div class="card-body">
    @if ($next == 0)
        @include('users.part.part1')
    @endif
    @if ($next == 1)
        @include('users.part.part2')
        <div class="float-end">
            <button type="button" wire:click="back" class="btn btn-secondary rounded-3 px-3 py-2 text-center">Back</button>
            <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center" wire:click="backButton" data-bs-dismiss="modal">Close</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#createConfirmationUserModal" class="btn btn-primary rounded-3 px-3 py-2 text-center"><i class="fas fa-save me-2"></i>Save</button>
        </div>
    @endif
    

</div>