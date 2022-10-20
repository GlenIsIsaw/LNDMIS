<div class="card-header">
    <h4>
        Edit {{$name}}'s Infomation  
    </h4>
</div>
<div class="card-body">
    @if ($next == 0)
        @include('users.part.part1')
    @endif
    @if ($next == 1)
    @include('users.part.part2')
        <div class="float-end">
            <button type="button" class="btn btn-secondary" wire:click="backButton" data-bs-dismiss="modal">Close</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#editConfirmationUserModal" class="btn btn-primary">Save</button>
        </div>
    @endif
</div>