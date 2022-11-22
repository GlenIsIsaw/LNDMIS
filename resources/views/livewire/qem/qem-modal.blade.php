<!-- Create Confirmation Qem Modal -->
<div wire:ignore.self class="modal fade" id="createConfirmationQemModal" tabindex="-1" aria-labelledby="createConfirmationQemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-uppercase fs-4" id="createConfirmationQemModalLabel">Confirmation</h5>
               
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

<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteQemModal" tabindex="-1" aria-labelledby="deleteQemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold fs-4" id="deleteQemModalLabel">Delete QEM</h5>
                
            </div>
            <form wire:submit.prevent="destroy">
                <div class="modal-body text-capitalize fs-6 fw-bold">
                    <h4>Are you sure you want to delete this data ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Confirmation Qem Modal -->
<div wire:ignore.self class="modal fade" id="editConfirmationQemModal" tabindex="-1" aria-labelledby="editConfirmationQemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-4 fw-bold text-uppercase" id="editConfirmationQemModalLabel">Confirmation</h5>
               
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body">
                    <h6 class="fs-6 fw-bold text-capitalize">Are you sure you want to update your QEM?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Submit Qem Modal -->
<div wire:ignore.self class="modal fade" id="submitQemModal" tabindex="-1" aria-labelledby="submitQemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-uppercase fs-4" id="submitQemModalLabel">Submit QEM</h5>
                
            </div>
            <form wire:submit.prevent="submit">
                <div class="modal-body fw-bold text-capitalize fs-6">
                    <h4>Are you sure you want to submit your QEM ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Approve Qem Modal -->
<div wire:ignore.self class="modal fade" id="approveQemModal" tabindex="-1" aria-labelledby="approveQemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-uppercase fs-4" id="approveQemModalLabel">Submit QEM</h5>
                
            </div>
            <form wire:submit.prevent="approve">
                <div class="modal-body fw-bold text-uppercase fs-6">
                    <h4>Are you sure you want to approve this QEM ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Filter Summary Modal -->
<div wire:ignore.self class="modal fade" id="filterQemModal" tabindex="-1" aria-labelledby="filterQemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-4 text-uppercase fw-bold" id="filterQemModalLabel">Filter QEM</h5>
                
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label  class="fw-bold">Search by Name:</label>
                        <input wire:model="filter_name" class="form-control border border-dark border-3 rounded-3" placeholder="Search..." />
                    </div>
                        <div class="mb-3">
                            <label  class="fw-bold">Search by Qem Title:</label>
                            <input wire:model="filter_certificate_title" class="form-control border  border-dark border-3 rounded-3" placeholder="Search..." />
                        </div>
                    
                    <label class="fw-bold">Sort by Date Created:</label>    
                    <div class="mx-3 my-3">
                        <label>Start Date</label>
                        <input type="date" wire:model="start_date" class="form-control border  border-dark border-3 rounded-3"> 

                        <label>End Date</label>
                        <input type="date" wire:model="end_date" class="form-control border  border-dark border-3 rounded-3">
                    </div>
                    


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>


<!-- Download Qem Modal -->
<div wire:ignore.self class="modal fade" id="printQemModal" tabindex="-1" aria-labelledby="printQemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-4 fw-bold text-uppercase" id="printQemModalLabel">Download All QEM</h5>
                
            </div>
            <form wire:submit.prevent="download">
                <div class="modal-body fs-6 text-capitalize fw-bold">
                    <h6>Are you sure you want to Download this?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Download</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Download All Qem Modal -->
<div wire:ignore.self class="modal fade" id="printAllQemModal" tabindex="-1" aria-labelledby="printAllQemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-4 text-uppercase fw-bold" id="printAllQemModalLabel">Download QEM</h5>
               
            </div>
            <form wire:submit.prevent="downloadAll">
                <div class="modal-body">
                    <h6 class="text-capitalize fs-6 fw-bold">Are you sure you want to download all of this?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Download</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Print Qem Reports Qem Modal -->
<div wire:ignore.self class="modal fade" id="printQemReportsModal" tabindex="-1" aria-labelledby="printQemReportsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-4 text-uppercase fw-bold" id="printQemReportsModalLabel">Download QEM Reports</h5>
                
            </div>
            <form wire:submit.prevent="printQemReports">
                <div class="modal-body">
                    <h6 class="text-capitalize fs-6 fw-bold">Are you sure you want to download all of this?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Download</button>
                </div>
            </form>
        </div>
    </div>
</div>