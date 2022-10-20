


<div>
                @if ($click)
                    <div class="container py-3 px-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="main-card">
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
                                </div>
                                
                            </div>
                        </div> 
                    </div>
                @else
        <div class="container py-3 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div id="main-card" style="padding-right: 5%">
                        <div class="card" >
                            <div class="card-header">
                                <h4>
                                    {{$table}}
                                    <button type="button"style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle" wire:click="resetFilter"><i class='fas fa-redo' wire:click="resetInput"></i></button>
                                    @if ($table == 'My Trainings')
                                        <input type="search" wire:model="filter_certificate_title" class="form-control float-end mx-2 border-3" placeholder="Search by Certificate Title" style="width: 230px" />
                                    @else
                                        <input type="search" wire:model="search" class="form-control float-end mx-2 border-3" placeholder="Search by Name" style="width: 230px" />
                                    @endif
                                    
                                    
                                </h4>
                                
                            </div>
                            
                            <div class="card-header bg-transparent border-0">
                                <div class="float-end mx-2">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#filterTrainingModal" class="btn-secondary text-white rounded-3 shadow text-lg px-5 py-10" style="background-color: #800;">Filter</button>
                                </div>
                            </div>
                                    
                                

                            <div class="card-body text-center">
                                <div class="table-responsive table-bordered text-center">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                @if ($table != "My Trainings")
                                                    <th scope="col">Name</th>
                                                @endif
                                                
                                                <th scope="col">Certificate Title</th>
                                                <th scope="col">Certificate Type</th>
                                                <th scope="col">Date Covered</th>
                                                <th scope="col">Level</th>
                                                <th scope="col">Number of Hours</th>
                                                <th scope="col">Venue</th>
                                                <th scope="col">Sponsors</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Attendance Form</th>
                                                <th scope="col" class="text-danger">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($trainings as $training)
                                                <tr>
                                                    @if ($table != "My Trainings")
                                                        <td>{{$training->name}}</td>
                                                    @endif
                                                    <td>{{$training->certificate_title}}</td>
                                                    <td>{{$training->certificate_type}}</td>
                                                    <td>{{ $training->date_covered }}</td>
                                                    <td>{{ $training->level }}</td>
                                                    <td>{{ $training->num_hours }}</td>
                                                    <td>{{ $training->venue }}</td>
                                                    <td>{{ $training->sponsors }}</td>
                                                    <td>{{ $training->type }}</td>
                                                    <td>{{ $training->status }}</td>
                                                    

                                                    
                                                    @if ($training->attendance_form == 0)
                                                
                                                        <td>
                                                            <div class="d-grid gap-2">
                                                            <button type="button" wire:click="createAttendanceForm({{$training->training_id}})" class="btn-danger text-white rounded-3 shadow-sm fw-bold px-5 py-2">Create</button></td>
                                                    @else
                                                        <td>
                                                            <div class="d-grid gap-2">
                                                            <button type="button" wire:click="showAttendanceForm({{$training->training_id}})" class="btn-success text-white rounded-3 shadow-sm fw-bold px-5 py-2">View</button>
                                                            @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')
                                                                <button type="button" wire:click="editAttendanceForm({{$training->training_id}})" class="btn-primary text-white rounded-3 shadow-sm fw-bold px-5 py-2">Edit</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteAttendanceModal" wire:click="deleteAttendanceForm({{$training->training_id}})" class="btn-danger rounded-3 fw-bold px-5 py-2">Delete</button>
                                                            @endif
                                                        </td>
                                                    @endif
                                                    </div>

                                                    
                                                    <td>
                                                        <div class="d-grid gap-2">
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#showTrainingModal" wire:click="show({{$training->training_id}})" class="btn-info text-white rounded-3 shadow-sm text-sm fw-bold px-3 py-2">View Certificate</button>
                                                            @if ($training->comment)
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#showCommentModal" wire:click="showComment({{$training->training_id}})" class="btn-info text-white rounded-3 shadow-sm text-sm fw-bold px-3 py-2">View Comment</button>
                                                            @endif
                                                        @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')
                                                            @if ($training->attendance_form == 1) 
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#submitTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-success rounded-3 shadow fw-bold px-5 py-2">Submit</button>
                                                            @endif
                                                        
                                                        @endif

                                                       

                                                        
                                                        @if ($training->status != 'Approved')
                                                    
                                                            @if ($training->status == 'Pending')
                                                                @if (auth()->user()->role_as == 1)
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#approveTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-success rounded-3 shadow-sm fw-bold text-sm px-5 py-2">Approve</button>
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#rejectTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-danger rounded-3 shadow-sm fw-bold text-sm px-5 py-2">Reject</button>
                                                                @endif    
                                                            @endif
                                                        
                                                    

                                                            @if($training->status != 'Pending')
                                                                <button type="button" wire:click="edit({{$training->training_id}})" class="btn-primary rounded-3 shadow fw-bold px-5 py-2">Edit</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-danger rounded-3 shadow-sm fw-bold px-5 py-2">Delete</button>
                                                            @endif
                                                            
                                                            
                                                                
                                                               
                                                                
                                                                @if ($training->status == 'Pending')
                                                                    @if (auth()->user()->role_as == 0)
                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#removeSubmissionTrainingModal" wire:click="delete({{$training->training_id}})" class=" btn-danger btn-lg rounded-pill shadow fw-bold px-5 py-10">Remove Submission</button>
                                                                    @endif    
                                                                @endif
                                                        @endif
                                                    </div>
                                                    </td>
                                                </tr>
                                            
                                            @empty    
                                                <tr>
                                                    <td colspan="20">No Record/s Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    {{ $trainings->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('livewire.training.training-modal')
    @include('livewire.main-modal')
</div>
    
    

