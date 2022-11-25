
    <div class="card-header">
        <div class="fw-bold fs-3 text-uppercase">
            Upload Training    
        </div>
    </div>
    <div class="card-body">
        @if ($this->next == 0)
            @include('invitation.part.part1')
        @endif
        @if ($this->next == 1)
            @include('invitation.part.part2')
        @endif
        @if ($this->next == 2)
            @include('invitation.part.part3')
            <div class="mt-3">
                <hr class="h-color mx-2 mt-3">
                <div class="float-end">
                    <button type="button" wire:click="back" class="btn btn-secondary rounded-3 px-3 py-2 text-center me-1" id="back" wire:loading.attr="disabled">Back</button>
                    <button type="button"  wire:click="backButton" class="btn btn-danger rounded-3 px-3 py-2 text-center me-1">Close</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#createConfirmationInvitationModal" class="btn btn-primary rounded-3 px-3 py-2 text-center"><i class="fas fa-save me-2"></i>Save</button>
                </div>
            </div>
        @endif
        

                

    </div>
