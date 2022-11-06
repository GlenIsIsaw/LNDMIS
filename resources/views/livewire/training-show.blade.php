

<div>
    
    @include('livewire.menu')
                @if ($state)
                    <div class="container py-3 px-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="main-card">
                                    <div class="card">
                                        @if ($state == 'createTraining')
                                            @include('trainings.create')
                                        @endif
                                        @if ($state == 'editTraining')
                                            @include('trainings.edit')
                                        @endif
                                        @if ($state == 'createAttendance')
                                            @include('attendanceForm.create')
                                        @endif
                                        @if ($state == 'editAttendance')
                                            @include('attendanceForm.edit')
                                        @endif
                                        @if ($state == 'showAttendance')
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
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#filterTrainingModal" class="btn-secondary text-uppercase fw-bold text-white rounded-3 shadow text-lg px-3 py-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>
                                </div>
                            </div>
                                    
                                

                            <div class="card-body text-center">
                                <div class="table-responsive table-bordered rounded-3 text-center">
                                    <table class="table table-bordered table-striped border-secondary border border-5 table-hover">
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
                                                <th scope="col" class="text-danger">Attendance Form Actions</th>
                                                <th scope="col" class="text-danger">Certificate Actions</th>
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
                                                            <div class="d-grid gap-2 mx-4">
                                                            <button type="button" wire:click="createAttendanceForm({{$training->training_id}})" class="btn-danger text-white rounded-3 shadow-sm fw-bold text-uppercase px-3 py-2"><i class="fas fa-pen"></i><br>Create</button>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <div class="d-grid gap-2 mx-4">
                                                        
                                                            <button type="button" wire:click="showAttendanceForm({{$training->training_id}})" class="btn-success text-white rounded-3 shadow-sm fw-bold text-uppercase px-3 py-2"><i class="fas fa-eye"></i><br>View</button>
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#printAttendanceModal" wire:click="signature({{$training->training_id}})" class="btn-success rounded-3 shadow-sm fw-bold text-uppercase px-3 py-2"><i class="fas fa-print"></i><br>Print</button>
                                                            @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')
                                                                <button type="button" wire:click="editAttendanceForm({{$training->training_id}})" class="btn-primary text-white rounded-3 shadow-sm fw-bold text-uppercase px-4 py-2"><i class="fas fa-edit"></i><br>Edit</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteAttendanceModal" wire:click="deleteAttendanceForm({{$training->training_id}})" class="btn-danger rounded-3 fw-bold px-3 py-2 text-uppercase"><i class="fas fa-trash fa-sm"></i><br>Delete</button>
                                                            @endif
                                                        </td>
                                                    @endif
                                                    </div>

                                                    
                                                    <td>
                                                        <div class="d-grid gap-2 mx-4">
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#showTrainingModal" wire:click="show({{$training->training_id}})" class="btn-info text-white rounded-3 fw-bold text-uppercase text-center px-3 py-2"><i class="fas fa-certificate"></i>Certificate</button>
                                                            @if ($training->comment)
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#showCommentModal" wire:click="showComment({{$training->training_id}})" class="btn-info text-white rounded-3 shadow-sm text-sm text-uppercase fw-bold px-3 py-2"><i class="fas fa-comments"></i>Comment</button>
                                                            @endif
                                                        @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')
                                                            @if ($training->attendance_form == 1) 
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#submitTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-success rounded-3 shadow text-uppercase fw-bold px-2 py-2"><i class="fas fa-paper-plane"></i><br>Submit</button>
                                                            @endif
                                                        
                                                        @endif

                                                       

                                                        
                                                        @if ($training->status != 'Approved')
                                                    
                                                            @if ($training->status == 'Pending')
                                                                @if (auth()->user()->role_as == 1)
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#approveTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-success rounded-3 shadow-sm fw-bold text-uppercase px-3 py-2"><i class="fas fa-thumbs-up "></i><br>Approve</button>
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#rejectTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-danger rounded-3 shadow-sm fw-bold text-sm text-uppercase px-3 py-2"><i class="fas fa-thumbs-down "></i><br>Reject</button>
                                                                @endif    
                                                            @endif
                                                        
                                                    

                                                            @if($training->status != 'Pending')
                                                                <button type="button" wire:click="edit({{$training->training_id}})" class="btn-primary rounded-3 shadow fw-bold text-uppercase px-3 py-2"><i class="fas fa-edit"></i><br>Edit</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-danger rounded-3 shadow-sm fw-bold px-3 py-2 text-uppercase"><i class="fas fa-trash"></i><br>Delete</button>
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
    @section('script')
    <script>
        
        window.addEventListener('toggle', event => {
            if(document.getElementById("wrapper").classList.contains('toggled')){
                document.getElementById('main-card').className = 'vw-100';
                document.getElementById('main-card').style.paddingRight = '15%';
            }else{
                document.getElementById('main-card').className = 'w-100';
                document.getElementById('main-card').style.paddingRight = '5%';
            }
        })
        window.addEventListener('close-modal', event => {

            $('#deleteTrainingModal').modal('hide');
            $('#updateTrainingModal').modal('hide');
            $('#deleteAttendanceModal').modal('hide');
            $('#printAttendanceModal').modal('hide');
            $('#updateAttendanceModal').modal('hide');
            $('#showAttendanceModal').modal('hide');
            $('#submitTrainingModal').modal('hide'); 
            $('#submitTrainingModal').modal('hide');
            $('#approveTrainingModal').modal('hide');
            $('#rejectTrainingModal').modal('hide');
            $('#removeSubmissionTrainingModal').modal('hide');
            $('#createConfirmationTrainingModal').modal('hide');
            $('#editConfirmationTrainingModal').modal('hide');
            $('#createConfirmationAttendanceModal').modal('hide');
            $('#editConfirmationAttendanceModal').modal('hide');


            $('#notificationModal').modal('hide');
            
            
        })
        window.addEventListener('show-notification', event => {

            $('#notificationModal').modal('show');
        })
        window.addEventListener('confirmation-create-training', event => {

            $('#createConfirmationTrainingModal').modal('show');
        })


    </script>

    @endsection
    
</div>


    
    

