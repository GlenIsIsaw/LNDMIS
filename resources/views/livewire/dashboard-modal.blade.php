<!-- Show Invitation Modal -->
<div wire:ignore.self class="modal fade" id="showInvitationModal" tabindex="-1" aria-labelledby="showInvitationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showInvitationModalLabel" class="text-break">Show {{$name}}</h5>
                <button type="button" class="btn btn-info text-white float-end fw-bold text-uppercase py-2 px-2 mx-3" style="background-image: linear-gradient(
                    to bottom, #43C6AC,
                    #191654);" wire:click="downloadCert"><i class="fas fa-download me-2"></i>Download</button>
                <button type="button" class="btn btn-danger px-3 mx-2 float-end" data-bs-dismiss="modal" aria-label="Close"
                ><i class="fas fa-times"></i></button>

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