<!-- Filter Summary Modal -->
<div wire:ignore.self class="modal fade" id="filterSummaryTrainingModal" tabindex="-1" aria-labelledby="filterSummaryTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterSummaryTrainingModalLabel">Filter Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label  class="fw-bold">Search by Name:</label>
                        <input wire:model="name" class="form-control border border-3 rounded-3" placeholder="Search..." />
                    </div>

                        <div class="mb-3">
                            <label  class="fw-bold">Search by Certificate Title:</label>
                            <input wire:model="filter_certificate_title" class="form-control border border-3 rounded-3" placeholder="Search..." />
                        </div>
                    
                    <div class="mb-3">
                        <label class="fw-bold">Sort by Certificate Type:</label>
                        <select type="text" wire:model="filter_certificate_type" class="form-control border border-3 rounded-3">
                                    <option value="">...</option>
                                    <option value="Certificate of Eligibility">Certificate of Eligibility</option>
                                    <option value="Certificate of Training">Certificate of Training</option>
                                    <option value="Certificate of Appreciation">Certificate of Appreciation</option>
                                    <option value="Certificate of Attendance">Certificate of Attendance</option>
                                    <option value="Certificate of Commendation">Certificate of Commendation</option>
                                    <option value="Certificate of Completion">Certificate of Completion</option>
                                    <option value="Certificate of Participation">Certificate of Participation</option>
                                    <option value="Certificate of Recognition">Certificate of Recognition</option>
                                    <option value="Membership Certificate">Membership Certificate</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Sort by Seminar Type:</label>
                        <select type="text" wire:model="filter_seminar_type" class="form-control border border-3 rounded-3">
                                    <option value="">...</option>
                                    <option value="Research Related Training">Research Related Training</option>
                                    <option value="Personal Development Training">Personal Development Training</option>
                                    <option value="Professional Development Training">Professional Development Training</option>
                                    <option value="Extension Related Training">Extension Related Training</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Sort by Level:</label>
                        <select wire:model="filter_level" class="form-control border border-3 rounded-3">
                            <option value="">...</option>
                            <option value="International">International</option>
                            <option value="Local">Local</option>
                            <option value="N/A">N/A</option>
                            <option value="National">National</option>
                            <option value="Regional">Regional</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Sort by Type:</label>
                        <select wire:model="filter_type" class="form-control border border-3 rounded-3">
                            <option value="">...</option>
                            <option value="Eligibility">Eligibility</option>
                            <option value="Event-Facilitator">Event-Facilitator</option>
                            <option value="Membership">Membership</option>
                            <option value="Seminar">Seminar</option>
                            <option value="Seminar-Facilitator">Seminar-Facilitator</option>
                        </select>
                    </div>
                    
                    
                    <label class="fw-bold">Sort by Date Covered:</label>    
                    <div class="mx-3 my-3">
                        <label>Start Date</label>
                        <input type="date" wire:model="start_date" class="form-control border border-3 rounded-3"> 

                        <label>End Date</label>
                        <input type="date" wire:model="end_date" class="form-control border border-3 rounded-3">
                    </div>
                    


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<!-- Filter Summary Modal -->
<div wire:ignore.self class="modal fade" id="printTrainingModal" tabindex="-1" aria-labelledby="printTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="printTrainingModalLabel">Download Trainings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="printAll">
                <div class="modal-body">
                    <h6 class="text-capitalize mb-3">Date Range:</h6>
                    <div class="mb-3 mx-3">
                        <label class="fw-bold">Start Date</label>
                        <input type="date" wire:model="start_date" class="form-control border-dark border-3">
                        @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3 mx-3">
                        <label class="fw-bold">End Date</label>
                        <input type="date" wire:model="end_date" class="form-control border-dark border-3">
                        @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mx-3">
                        <label>
                            <input class="border-dark border-3" type="checkbox" wire:model="mySignature">
                            Include My Signature
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Print All</button>
                </div>
            </form>
        </div>
    </div>
</div>

