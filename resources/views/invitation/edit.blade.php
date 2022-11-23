
    <div class="card-header">
        <div class="fw-bold fs-3 text-uppercase">
            Edit Training    
        </div>
    </div>
    <div class="card-body">
        @include('invitation.part.part1')
        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#showInvitationModal" wire:click="show({{$invitation_id}})" style="color: #800">
            View File Attachment Here
       </button>
        
        </div> 
                <div class="mt-3">
                    <hr class="h-color mx-2 mt-3">
                    <div class="float-end">
               
                        <button type="button"  wire:click="backButton" class="btn btn-danger rounded-3 px-3 py-2 text-center me-1">Close</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#editConfirmationInvitationModal" class="btn btn-primary rounded-3 px-3 py-2 text-center"><i class="fas fa-save me-2"></i>Save</button>
                    </div>
                </div>
                

    </div>
