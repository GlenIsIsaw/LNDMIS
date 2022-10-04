<!-- Create Modal -->
<div wire:ignore.self class="modal fade" id="createTrainingModal" tabindex="-1" aria-labelledby="createTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTrainingModalLabel">Create Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <select wire:model="user_id" class="form-control">
                            <option value=""></option>
                            <option value="{{auth()->user()->id}}">{{auth()->user()->name}}</option>
                        </select>
                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Certificate Types</label>
                        <select type="text" wire:model="certificate_type" class="form-control">
                            <option value=""></option>
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
                        @error('certificate_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Certificate Name</label>
                        <input type="text" wire:model="certificate_title" class="form-control">
                        @error('certificate_title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Level</label>
                        <select wire:model="level" class="form-control">
                            <option value=""></option>
                            <option value="International">International</option>
                            <option value="Local">Local</option>
                            <option value="N/A">N/A</option>
                            <option value="National">National</option>
                            <option value="Regional">Regional</option>
                        </select>
                        @error('level') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Date Covered</label>
                        <input type="date" wire:model="date_covered" class="form-control">
                        @error('date_covered') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Venue</label>
                        <input type="text" wire:model="venue" class="form-control">
                        @error('venue') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Sponsors</label>
                        <input type="text" wire:model="sponsors" class="form-control">
                        @error('sponsors') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Number of Hours</label>
                        <input type="number" wire:model="num_hours" class="form-control">
                        @error('num_hours') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Type</label>
                        <select wire:model="type" class="form-control">
                            <option value=""></option>
                            <option value="Eligibility">Eligibility</option>
                            <option value="Event-Facilitator">Event-Facilitator</option>
                            <option value="Membership">Membership</option>
                            <option value="Seminar">Seminar</option>
                            <option value="Seminar-Facilitator">Seminar-Facilitator</option>
                        </select>
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Attach the Certificate Photo</label>
                        <input type="file" wire:model="photo" class="form-control">
                        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Update Modal -->
<div wire:ignore.self class="modal fade" id="updateTrainingModal" tabindex="-1" aria-labelledby="updateTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateTrainingModalLabel">Update {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label>Name</label>
                        <select wire:model="user_id" class="form-control">
                            <option value=""></option>
                            <option value="{{auth()->user()->id}}">{{auth()->user()->name}}</option>
                        </select>
                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Certificate Types</label>
                        <select type="text" wire:model="certificate_type" class="form-control">
                            <option value=""></option>
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
                        @error('certificate_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Certificate Name</label>
                        <input type="text" wire:model="certificate_title" class="form-control">
                        @error('certificate_title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Level</label>
                        <select wire:model="level" class="form-control">
                            <option value=""></option>
                            <option value="International">International</option>
                            <option value="Local">Local</option>
                            <option value="N/A">N/A</option>
                            <option value="National">National</option>
                            <option value="Regional">Regional</option>
                        </select>
                        @error('level') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Date Covered</label>
                        <input type="date" wire:model="date_covered" class="form-control">
                        @error('date_covered') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Venue</label>
                        <input type="text" wire:model="venue" class="form-control">
                        @error('venue') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Sponsors</label>
                        <input type="text" wire:model="sponsors" class="form-control">
                        @error('sponsors') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Number of Hours</label>
                        <input type="number" wire:model="num_hours" class="form-control">
                        @error('num_hours') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Type</label>
                        <select wire:model="type" class="form-control">
                            <option value=""></option>
                            <option value="Eligibility">Eligibility</option>
                            <option value="Event-Facilitator">Event-Facilitator</option>
                            <option value="Membership">Membership</option>
                            <option value="Seminar">Seminar</option>
                            <option value="Seminar-Facilitator">Seminar-Facilitator</option>
                        </select>
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Attach the Certificate Photo</label>
                        <input type="file" wire:model="photo" class="form-control">
                        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                        <img class="img-fluid" src="{{ url('storage/users/'.$name.'/'.$certificate) }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Show Modal -->
<div wire:ignore.self class="modal fade" id="showTrainingModal" tabindex="-1" aria-labelledby="showTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTrainingModalLabel">Show {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <div class="modal-body">

                    <table class="table table-borderd table-striped">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{$name}}</td>
                            </tr>
                            <tr>
                                <th>Certificate Type</th>
                                <td>{{$certificate_type}}</td>
                            </tr>
                            <tr>
                                <th>Certificate Title</th>
                                <td>{{$certificate_title}}</td>
                            </tr>
                            <tr>
                                <th>Level</th>
                                <td>{{$level}}</td>
                            </tr>
                            <tr>
                                <th>Venue</th>
                                <td>{{$venue}}</td>
                            </tr>
                            <tr>
                                <th>Sponsors</th>
                                <td>{{$sponsors}}</td>
                            </tr>
                            <tr>
                                <th>Date Covered</th>
                                <td>{{$date_covered}}</td>
                            </tr>
                            <tr>
                                <th>Number of Hours</th>
                                <td>{{$num_hours}}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>{{$type}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{$status}}</td>
                            </tr>
                            <tr>
                                <th>Attendance Form</th>
                                @if ($attendance_form == 0)
                                    <td><button type="button" data-bs-toggle="modal" data-bs-target="#createAttendanceModal" wire:click="editAttendanceForm({{$ListOfTraining_id}})" class="btn btn-warning">Create Attendance Report</button></td>
                                @else
                                    <td><button type="button" data-bs-toggle="modal" data-bs-target="#showAttendanceModal" wire:click="editAttendanceForm({{$ListOfTraining_id}})" class="btn btn-primary">View Attendance Report</button></td>
                                @endif
                            </tr>
                            @if ($comment != null)
                                <tr>
                                    <th>Comment</th>
                                    <td>{{$comment}}</td>
                                </tr>
                            @endif

                            <tr>
                                <th>Certificate</th>
                                <td><img class="img-fluid" src="{{ url('storage/users/'.$name.'/'.$certificate) }}"></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                @if ($status == 'Not Submitted' || $status == 'Rejected')
                    <button type="button" data-bs-toggle="modal" data-bs-target="#submitTrainingModal" wire:click="delete({{$ListOfTraining_id}})" class="btn btn-success">Submit</button>
                @endif
                @if ($status == 'Pending')
                <button type="button" data-bs-toggle="modal" data-bs-target="#removeSubmissionTrainingModal" wire:click="delete({{$ListOfTraining_id}})" class="btn btn-danger">Remove Submission</button>
                @endif
                @if ($status != 'Approved')
                    @if ($status == 'Pending')
                        @if (auth()->user()->role_as == 1)
                            <button type="button" data-bs-toggle="modal" data-bs-target="#approveTrainingModal" wire:click="delete({{$ListOfTraining_id}})" class="btn btn-success">Approve</button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#rejectTrainingModal" wire:click="delete({{$ListOfTraining_id}})" class="btn btn-danger">Reject</button>
                        @endif    
                    @endif

                    <button type="button" data-bs-toggle="modal" data-bs-target="#updateTrainingModal" wire:click="edit({{$ListOfTraining_id}})" class="btn btn-primary">Edit</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteTrainingModal" wire:click="delete({{$ListOfTraining_id}})" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                
                @else
                    @if (auth()->user()->role_as == 1)
                        <button type="button" data-bs-toggle="modal" data-bs-target="#updateTrainingModal" wire:click="edit({{$ListOfTraining_id}})" class="btn btn-primary">Edit</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#deleteTrainingModal" wire:click="delete({{$ListOfTraining_id}})" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                    @endif
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
                <h5 class="modal-title" id="deleteTrainingModalLabel">Delete {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroy">
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

<!-- Submit Training Modal -->
<div wire:ignore.self class="modal fade" id="submitTrainingModal" tabindex="-1" aria-labelledby="submitTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitTrainingModalLabel">Submit {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit">
                <div class="modal-body">
                    <h4>Are you sure you want to submit your input ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
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

<!-- Create Attendance Modal -->
<div wire:ignore.self class="modal fade" id="createAttendanceModal" tabindex="-1" aria-labelledby="createAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAttendanceModalLabel">Create Attendance Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <form wire:submit.prevent="storeAttendanceForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <select wire:model="ListOfTraining_id" class="form-control">
                            <option value=""></option>
                            <option value="{{$ListOfTraining_id}}">{{$name}}</option>
                        </select>
                        @error('ListOfTraining_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Specific Competency Target to Enhance</label>
                        <select wire:model="competency" class="form-control">
                            <option value=""></option>
                            @foreach ($comps as $key => $comp)
                            <optgroup label={{$key}}>
                                @foreach ($comp as $item)
                                <option value="{{$item->competency_name}}">{{$item->competency_name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('competency') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Knowledge Acquired (What skills, knowledge and attitudes acquired?)</label>
                        <textarea wire:model="knowledge_acquired" rows="4" cols="50" class="form-control"></textarea>
                        @error('knowledge_acquired') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Outcome</label>
                        <textarea wire:model="outcome" rows="4" cols="50" class="form-control"></textarea>
                        @error('outcome') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Personal Action</label>
                        <textarea wire:model="personal_action" rows="4" cols="50" class="form-control"></textarea>
                        @error('personal_action') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Show Atendance Modal -->
<div wire:ignore.self class="modal fade" id="showAttendanceModal" tabindex="-1" aria-labelledby="showAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showAttendanceModalLabel">{{$certificate_title}}'s Attendance Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <div class="modal-body">
                    <table class="table table-borderd table-striped">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{$name}}</td>
                            </tr>
                            <tr>
                                <th>Title of Intervention Attended</th>
                                <td>{{$certificate_title}}</td>
                            </tr>
                            <tr>
                                <th>Date Conducted</th>
                                <td>{{$certificate_title}}</td>
                            </tr>
                            <tr>
                                <th>Venue</th>
                                <td>{{$venue}}</td>
                            </tr>
                            <tr>
                                <th>Sponsors</th>
                                <td>{{$sponsors}}</td>
                            </tr>
                                <th>Specific Competency to Develop/Enhance</th>
                                <td>{{$competency}}</td>
                            </tr>
                            <tr>
                                <th>Knowledge Acquired</th>
                                <td>{{$knowledge_acquired}}</td>
                            </tr>
                            <tr>
                                <th>Outcome</th>
                                <td>{{$outcome}}</td>
                            </tr>
                            <tr>
                                <th>Personal Action</th>
                                <td>{{$personal_action}}</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-toggle="modal" data-bs-target="#printAttendanceModal" wire:click="delete({{$ListOfTraining_id}})" class="btn btn-success">Print</button>
                @if ($status == 'Not Submitted' || $status == 'Rejected')
                    <button type="button" data-bs-toggle="modal" data-bs-target="#updateAttendanceModal" wire:click="editAttendanceForm({{$att_id}})" class="btn btn-primary">Edit</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteAttendanceModal" wire:click="deleteAttendanceForm({{$att_id}})" class="btn btn-danger">Delete</button>
                @endif

                <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Atendance Modal -->
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
                <h5 class="modal-title" id="deleteAttendanceModalLabel">Print Attendance Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="printAttendanceForm">
                <div class="modal-body">
                    <h4>Are you sure you want to print this Attendance Form ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Print</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Attendance Modal -->
<div wire:ignore.self class="modal fade" id="updateAttendanceModal" tabindex="-1" aria-labelledby="updateAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAttendanceModalLabel">Update Attendance Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <form wire:submit.prevent="updateAttendanceForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <select wire:model="ListOfTraining_id" class="form-control">
                            <option value=""></option>
                            <option value="{{$ListOfTraining_id}}">{{$name}}</option>
                        </select>
                        @error('ListOfTraining_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Specific Competency Target to Enhance</label>
                        <select wire:model="competency" class="form-control">
                            <option value=""></option>
                            @foreach ($comps as $key => $comp)
                            <optgroup label={{$key}}>
                                @foreach ($comp as $item)
                                <option value="{{$item->competency_name}}">{{$item->competency_name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('competency') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Knowledge Acquired (What skills, knowledge and attitudes acquired?)</label>
                        <textarea wire:model="knowledge_acquired" rows="4" cols="50" class="form-control"></textarea>
                        @error('knowledge_acquired') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Outcome</label>
                        <textarea wire:model="outcome" rows="4" cols="50" class="form-control"></textarea>
                        @error('outcome') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Personal Action</label>
                        <textarea wire:model="personal_action" rows="4" cols="50" class="form-control"></textarea>
                        @error('personal_action') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Approve Training Modal -->
<div wire:ignore.self class="modal fade" id="approveTrainingModal" tabindex="-1" aria-labelledby="approveTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveTrainingModalLabel">Approve the Submitted Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="approve">
                <div class="modal-body">
                    <div class="mb-3">
                        <h4>Are you sure you want to Approve this Submission ?</h4>
                        <label>Comment:</label>
                        <textarea wire:model="comment" rows="4" cols="50" class="form-control"></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Training Modal -->
<div wire:ignore.self class="modal fade" id="rejectTrainingModal" tabindex="-1" aria-labelledby="rejectTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectTrainingModalLabel">Reject the Submitted Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="reject">
                <div class="modal-body">
                    <div class="mb-3">
                        <h4>Are you sure you want to Reject this Submission ?</h4>
                        <label>Comment:</label>
                        <textarea wire:model="comment" rows="4" cols="50" class="form-control"></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>