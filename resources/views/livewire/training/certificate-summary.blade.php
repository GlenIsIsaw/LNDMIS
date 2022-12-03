<!-- Filter Summary Modal -->
<div wire:ignore.self class="modal fade" id="filterSummaryCertificateModal" tabindex="-1" aria-labelledby="filterSummaryCertificateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="filterSummaryCertificateModalLabel">Filter Certificate</h5>
               
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label  class="fw-bold">Search by Name:</label>
                        <input wire:model="name" class="form-control border border-3 border-dark rounded-3" placeholder="Search..." />
                    </div>
                        <div class="mb-3">
                            <label  class="fw-bold">Search by Certificate Title:</label>
                            <input wire:model="filter_certificate_title" class="form-control border border-3 border-dark rounded-3" placeholder="Search..." />
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

<!-- Show Certificate Modal -->
<div wire:ignore.self class="modal fade" id="showCertificateModal" tabindex="-1" aria-labelledby="showCertificateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCertificateModalLabel" class="text-break">Show {{$certificate_title}}</h5>
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
                        border: none;" src="{{ url('storage/users/'.$user_id.'/'.$certificate_name) }}?{{ rand() }}"></iframe>
                    </div>

                @else
                <img class="img-fluid justify-center" style="justify-center" src="{{ url('storage/users/'.$user_id.'/'.$certificate_name) }}?{{ rand() }}">
                @endif
                

            </div>
        </div>
    </div>
</div>

<!-- Print Certificate Modal -->
<div wire:ignore.self class="modal fade" id="printCertificateModal" tabindex="-1" aria-labelledby="printCertificateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-uppercase" id="printCertificateModalLabel">Download Certificates</h5>
                
            </div>
            <form wire:submit.prevent="printAll">
                <div class="modal-body fw-bold fs-6 text-capitalize">
                    Are you sure you want to download this?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Download All</button>
                </div>
            </form>
        </div>
    </div>
</div>