
<!-- Show Training Modal -->
<div wire:ignore.self class="modal fade" id="showTrainingModal" tabindex="-1" aria-labelledby="showTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="showTrainingModalLabel" class="text-break">Show {{$certificate_title}}</h5>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-info text-white float-start text-uppercase py-1" style="background-image: linear-gradient(
                    to bottom, #43C6AC,
                    #191654);" wire:click="downloadCert"><i class="fas fa-download me-2"></i>Download</button>
                @if ($state == 'editTraining')
                    <button type="button" class="btn btn-danger px-3 mx-2 float-end" data-bs-dismiss="modal" aria-label="Close"
                    ><i class="fas fa-times"></i></button>
                @else
                    <button type="button" class="btn btn-danger px-3 mx-2 float-end" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"><i class="fas fa-times"></i></button>
                @endif
                </div>
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
                        border: none;" src="{{ url('storage/users/'.$user_id.'/'.$certificate) }}?{{ rand() }}"></iframe>
                    </div>

                @else
                    <img class="img-fluid justify-center" style="justify-center" src="{{ url('storage/users/'.$user_id.'/'.$certificate) }}?{{ rand() }}">
                @endif
                

            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteTrainingModal" tabindex="-1" aria-labelledby="deleteTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="deleteTrainingModalLabel">Delete {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroy">
                <div class="modal-body text-uppercase fw-bold">
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

<!-- Create Confirmation Training Modal -->
<div wire:ignore.self class="modal fade" id="createConfirmationTrainingModal" tabindex="-1" aria-labelledby="createConfirmationTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createConfirmationTrainingModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
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

<!-- Edit Confirmation Training Modal -->
<div wire:ignore.self class="modal fade" id="editConfirmationTrainingModal" tabindex="-1" aria-labelledby="editConfirmationTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="editConfirmationTrainingModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body fw-bold text-uppercase">
                    <h6>Are you sure you want to edit your training info?</h6>
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

<!-- Submit Training Modal -->
<div wire:ignore.self class="modal fade" id="submitTrainingModal" tabindex="-1" aria-labelledby="submitTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-uppercase" id="submitTrainingModalLabel">Submit {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit">
                <div class="modal-body fw-bold text-uppercase">
                    <h4>Are you sure you want to submit your input ?</h4>
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

<!-- Remove Submit Training Modal -->
<div wire:ignore.self class="modal fade" id="removeSubmissionTrainingModal" tabindex="-1" aria-labelledby="removeSubmissionTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeSubmissionTrainingModalLabel">Remove Submission of {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="removeSubmit">
                <div class="modal-body">
                    <h4>Are you sure you want to remove your submission ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Remove Submission</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Delete Attendance Modal -->
<div wire:ignore.self class="modal fade" id="deleteAttendanceModal" tabindex="-1" aria-labelledby="deleteAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAttendanceModalLabel">Delete {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyAttendanceForm">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this data ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Print Atendance Modal -->
<div wire:ignore.self class="modal fade" id="printAttendanceModal" tabindex="-1" aria-labelledby="printAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="printAttendanceModalLabel">Print Attendance Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="printAttendanceForm">
                <div class="modal-body text-uppercase fw-bold">
                    <h4>Are you sure you want to print this Attendance Form ?</h4>
                    <hr class="h-color mx-2">
                    @if ($checkmySignature)
                        <label>
                            <input type="checkbox" wire:model="mySignature">
                            Include My Signature
                        </label>
                    @endif

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Print</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Confirmation Attendance Modal -->
<div wire:ignore.self class="modal fade" id="createConfirmationAttendanceModal" tabindex="-1" aria-labelledby="createConfirmationAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="createConfirmationAttendanceModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeAttendanceForm">
                <div class="modal-body text-uppercase fw-bold">
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

<!-- Edit Confirmation Training Modal -->
<div wire:ignore.self class="modal fade" id="editConfirmationAttendanceModal" tabindex="-1" aria-labelledby="editConfirmationAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="editConfirmationAttendanceModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="updateAttendanceForm">
                <div class="modal-body">
                    <h6>Are you sure you want to edit your Attendance Form info?</h6>
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
 
<!-- Approve Training Modal -->
<div wire:ignore.self class="modal fade" id="approveTrainingModal" tabindex="-1" aria-labelledby="approveTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="approveTrainingModalLabel">Approve the Submitted Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="approve">
                <div class="modal-body">
                    <div class="mb-3">
                        <h4>Are you sure you want to Approve this Submission ?</h4>
                        <hr class="h-color mx-2 mt-3">
                        <label class="mb-3 fw-bold text-uppercase">Comment:</label>
                        <textarea wire:model="comment" rows="4" cols="50" class="form-control border-3 border-dark"></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
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

<!-- Show Comment Training Modal -->
<div wire:ignore.self class="modal fade" id="showCommentModal" tabindex="-1" aria-labelledby="showCommentModalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="showCommentModalLabel">Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        
                        <p class="fs-4 lh-base text-md-start">{{$comment}}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<!-- Reject Training Modal -->
<div wire:ignore.self class="modal fade" id="rejectTrainingModal" tabindex="-1" aria-labelledby="rejectTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="rejectTrainingModalLabel">Reject the Submitted Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="reject">
                <div class="modal-body">
                    <div class="mb-3">
                        <h4>Are you sure you want to Reject this Submission ?</h4>
                        <hr class="h-color mx-2 mt-3">
                        <label class="fw-bold text-uppercase mb-3">Comment:</label>
                        <textarea wire:model="comment" rows="4" cols="50" class="form-control border-3 border-dark"></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Filter Modal -->
<div wire:ignore.self class="modal fade" id="filterTrainingModal" tabindex="-1" aria-labelledby="filterTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterTrainingModalLabel">Filter Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    @if ($table != 'My Trainings')
                        <div class="mb-3">
                            <label  class="fw-bold">Search by Certificate Title:</label>
                            <input type="search" wire:model="filter_certificate_title" class="form-control border border-dark border-3 rounded-3" placeholder="Search..." />
                        </div>
                    @endif
 
                    <div class="mb-3">
                        <label class="fw-bold">Sort by Status:</label>
                        <select wire:model="filter_status" class="form-control border border-dark border-3 rounded-3">
                            <option value="">...</option>
                            <option value="Approved">Approved</option>
                            <option value="Not Submitted">Not Submitted</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="fw-bold">Sort by Certificate Type:</label>
                        <select type="text" wire:model="filter_certificate_type" class="form-control border border-dark border-3 rounded-3">
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
                        <label class="fw-bold">Sort by Level:</label>
                        <select wire:model="filter_level" class="form-control border border-dark border-3 rounded-3">
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
                        <select wire:model="filter_type" class="form-control border border-dark border-3 rounded-3">
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
                        <input type="date" wire:model="start_date" class="form-control border border-dark border-3 rounded-3"> 

                        <label>End Date</label>
                        <input type="date" wire:model="end_date" class="form-control border border-dark border-3 rounded-3">
                    </div>
                    


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>