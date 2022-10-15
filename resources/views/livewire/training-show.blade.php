


<div>
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12 mr-3">
                @if ($click)
                    <div class="card">
                        @if ($create)
                            @include('trainings.create')
                        @endif
                        @if ($update)
                            @include('trainings.edit')
                        @endif
                        @if ($createAttendanceForm)
                            @include('attendanceForm.create')
                        @endif
                        @if ($editAttendanceForm)
                            @include('attendanceForm.edit')
                        @endif
                        @if ($showAttendanceForm)
                            @include('attendanceForm.show')
                        @endif
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{$table}}
                                <button type="button" class="float-end" wire:click="resetInput"><i class='fas fa-redo' wire:click="resetInput"></i></button>
                                <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                                
                            </h4>
                            
                        </div>
                        
                        <div class="card-header bg-transparent border-0">
                            <div class="float-end mx-2">
                                <label>Sort By</label>
                                <select wire:model="filterStatus" class="text-center text-center border border-dark border-2 rounded">
                                    <option value="">Default</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Not Submitted">Not Submitted</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="Pending">Pending</option>
                                </select>
                                <label>Start Date</label>
                                <input type="date" wire:model="start_date">
                                <label>End Date</label>
                                <input type="date" wire:model="end_date">
                                
                            </div>
                        </div>
                                
                            

                        <div class="card-body">
                            <div class="table-responsive table-bordered text-center">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            @if ($table != "My Trainings")
                                                <th scope="col">Name</th>
                                            @endif
                                            
                                            <th scope="col">Certificate Title</th>
                                            <th scope="col">Date Covered</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Number of Hours</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">Sponsors</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Attendance Report</th>
                                            <th scope="col" class="text-danger">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($trainings as $training)
                                            <tr>
                                                @if ($table != "My Trainings")
                                                    <td>{{$training->name}}</td>
                                                @endif
                                                <td class="text-break">{{$training->certificate_title}}</td>
                                                <td class="text-break">{{ $training->date_covered }}</td>
                                                <td>{{ $training->level }}</td>
                                                <td class="text-break">{{ $training->num_hours }}</td>
                                                <td class="text-break">{{ $training->venue }}</td>
                                                <td>{{ $training->sponsors }}</td>
                                                <td>{{ $training->status }}</td>
                                                 
                                                @if ($training->attendance_form == 0)
                                                    <td><button type="button" wire:click="createAttendanceForm({{$training->training_id}})" class="btn-warning btn-lg text-white rounded-pill shadow fw-bold px-5 py-10">Create</button></td>
                                                @else
                                                    <td>
                                                        <button type="button" wire:click="showAttendanceForm({{$training->training_id}})" class="btn-info btn-lg rounded-pill shadow fw-bold  px-5 py-10">View</button>
                                                        @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')
                                                            <button type="button" wire:click="editAttendanceForm({{$training->training_id}})" class="btn-primary btn-lg rounded-pill shadow fw-bold px-5 py-10">Edit</button>
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteAttendanceModal" wire:click="deleteAttendanceForm({{$training->training_id}})" class="btn-danger px-5 py-10">Delete</button>
                                                        @endif
                                                    </td>
                                                @endif
                                                

                                                
                                                <td>
                                                    <div class="d-grid gap-2">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#showTrainingModal" wire:click="show({{$training->training_id}})" class="btn-info text-white rounded-pill shadow fw-bold text-sm px-5 py-10">View Certificate</button>
                                                    @if ($training->comment)
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#showCommentModal" wire:click="showComment({{$training->training_id}})" class="btn-info btn-lg rounded-pill shadow fw-bold px-5 py-10">View Comment</button>
                                                    @endif


                                                    @if ($training->status != 'Approved')
                                                        @if ($training->status == 'Pending')
                                                            @if (auth()->user()->role_as == 1)
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#approveTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-success btn-lg rounded-pill shadow fw-bold px-5 py-10">Approve</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#rejectTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-danger btn-lg rounded-pill shadow fw-bold px-5 py-10">Reject</button>
                                                            @endif    
                                                        @endif

                                                            @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')
                                                                @if ($training->attendance_form == 1) 
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#submitTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-success btn-lg rounded-pill shadow fw-bold px-5 py-10">Submit</button>
                                                                @endif
                                                                
                                                            @endif
                                                            @if ($training->status == 'Pending')
                                                                @if (auth()->user()->role_as == 0)
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#removeSubmissionTrainingModal" wire:click="delete({{$training->training_id}})" class=" btn-danger btn-lg rounded-pill shadow fw-bold px-5 py-10">Remove Submission</button>
                                                                @endif    
                                                            @else
                                                                <button type="button" wire:click="edit({{$training->training_id}})" class="btn-primary btn-lg rounded-pill shadow fw-bold px-5 py-10">Edit</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-danger btn-lg rounded-pill shadow fw-bold px-5 py-10">Delete</button>
                                                            @endif
                                                    @endif
                                                </div>
                                                </td>
                                            </tr>
                                        
                                        @empty    
                                            <tr>
                                                <td colspan="10">No Record/s Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                {{ $trainings->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('livewire.training.training-modal')
    @include('livewire.main-modal')
</div>
    
    

