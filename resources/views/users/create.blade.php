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
            <button type="button" class="btn btn-danger" wire:click="backButton" data-bs-dismiss="modal">Close</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#createConfirmationUserModal" class="btn btn-primary">Save</button>
        </div>
    @endif
    

</div>