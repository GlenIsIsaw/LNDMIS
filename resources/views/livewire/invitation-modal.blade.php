<!-- Create Confirmation Invitation Modal -->
<div wire:ignore.self class="modal fade" id="createConfirmationInvitationModal" tabindex="-1" aria-labelledby="createConfirmationInvitationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold fs-4" id="createConfirmationInvitationModalLabel">Confirmation</h5>
                
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body text-capitalize fs-6 fw-bold">
                    <h6>Are you sure you want to save your Input?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Save Input</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Show Invitation Modal -->
<div wire:ignore.self class="modal fade" id="showInvitationModal" tabindex="-1" aria-labelledby="showInvitationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showInvitationModalLabel" class="text-break">Show {{$name}}</h5>
                <button type="button" class="btn-close mx-2 float-end card-header" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="resetInput"></button>
            </div>
            <div class="modal-body">
                
                @if ($fileType == "pdf")
                    <div class="container" style="  position: relative;
                    width: 100%;
                    overflow: hidden;
                    padding-top: 56.25%; /* 16:9 Aspect Ratio */">
                        <iframe class="responsive-iframe" style="  position: absolute;
                        top: 0;
                        left: 0;
                        bottom: 0;
                        right: 0;
                        width: 100%;
                        height: 100%;
                        border: none;" src="{{ url('storage/users/IncomingTrainings/'.$file) }}?{{ rand() }}"></iframe>
                    </div>

                @else
                <img class="img-fluid justify-center" style="justify-center" src="{{ url('storage/users/IncomingTrainings/'.$file) }}?{{ rand() }}">
                @endif
                

            </div>
        </div>
    </div>
</div>

<!-- Filter Summary Modal -->
<div wire:ignore.self class="modal fade" id="filterInvitationModal" tabindex="-1" aria-labelledby="filterInvitationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="filterInvitationModalLabel">Filter Certificate</h5>
               
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label  class="fw-bold">Search by Name:</label>
                        <input wire:model="filter_name" class="form-control border border-3 border-dark rounded-3" placeholder="Search..." />
                    </div>
                    
                    <label class="fw-bold">Sort by Date Covered:</label>    
                    <div class="mx-3 my-3">
                        <label>Start Date</label>
                        <input type="date" wire:model="start_date" class="form-control border border-3 border-dark rounded-3"> 

                        <label>End Date</label>
                        <input type="date" wire:model="end_date" class="form-control border border-3 border-dark rounded-3">
                    </div>
                    


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>