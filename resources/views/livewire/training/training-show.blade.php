

<div>
    
    @include('livewire.menu')
                @if ($state)
                    <div class="container py-2">
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
                                        @if ($state == 'showTraining')
                                            @include('trainings.show')
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
        <div class="container py-2">
            <div class="row">
                <div class="col-md-12">
                    <div id="main-card" style="padding-right: 2%;">
                        <div class="card" >
                            <div class="card-header border-0">
                                <h3 class="fw-bold text-uppercase align-middle py-1">
                                    {{$table}}
                                    <button type="button"style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle" wire:click="resetFilter"><i class='fas fa-redo' wire:click="resetInput"></i></button>
                                    @if ($table == 'My Trainings')
                                        <input type="search" wire:model="filter_certificate_title" class="form-control float-end mx-2 border-3" placeholder="Search by Certificate Title" style="width: 230px" />
                                    @else
                                        <input type="search" wire:model="search" class="form-control float-end mx-2 border-3" placeholder="Search by Name" style="width: 230px" />
                                    @endif
                                    
                                    
                                </h3>
                                
                            </div>
                            
                            <div class="card-header mb-1 border-0">
                                @if ($table == 'My Trainings')
                                <div class="container-fluid">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <div class="p-1 shadow-sm d-flex justify-content-around align-items-center rounded-3" style="background-color: #FEFCFF">
                                                <div>
                                        <h6 class="fs-2 fw-bolder" style="color: #926F34">{{$approved}}  </h6>
                                        <p class="fs-6 fw-bold">Approved </p>
                                                </div>
                                               <i class="fas fa-thumbs-up fa-2x p-1 me-2" style="color: #800;" ></i>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="p-1  shadow-sm d-flex justify-content-around align-items-center rounded-3" style="background-color: #FEFCFF">
                                                <div>
                                                    <h6 class="fs-2 fw-bolder" style="color: #926F34">  {{$rejected}} </h6> 
                                                    <p class="fs-6 fw-bold">Disapprove</p>
                                                </div>
                                                <i class="fas fa-thumbs-down fa-2x  p-1 me-2" style="color: #800;"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="p-1 shadow-sm d-flex justify-content-around align-items-center rounded-3" style="background-color: #FEFCFF">
                                                <div>
                                                    <h6 class="fs-2 fw-bolder" style="color: #926F34">  {{$notSubmitted}}  </h6>  
                                                    <p class="fs-6 fw-bold">Ongoing</p>
                                                </div>
                                                <i class="fas fa-times-circle fa-2x p-1 me-2" style="color: #800;"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="p-1 shadow-sm d-flex justify-content-around align-items-center rounded-3" style="background-color: #FEFCFF">
                                                <div>
                                                    <h6 class="fs-2 fw-bolder" style="color: #926F34"> {{$pending}} </h6>
                                                    <p class="fs-6 fw-bold">Pending</p>
                                                </div>
                                                    <i class="fas fa-clock fa-2x p-1 me-2" style="color: #800;"></i>
                                                
                                    </div>
                                </div>
                                    </div>
                                </div>
                                @else
                                <div class="container-fluid">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <div class="p-1 shadow-sm d-flex justify-content-around align-items-center rounded-3" style="background-color: #FEFCFF">
                                                <div>
                                        <h6 class="fs-2 fw-bolder" style="color: #926F34">{{$approved}}  </h6>
                                        <p class="fs-6 fw-bold">Approved </p>
                                                </div>
                                               <i class="fas fa-thumbs-up fa-2x p-1 me-2" style="color: #800;" ></i>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="p-1 shadow-sm d-flex justify-content-around align-items-center rounded-3" style="background-color: #FEFCFF">
                                                <div>
                                                    <h6 class="fs-2 fw-bolder" style="color: #926F34"> {{$pending}} </h6>
                                                    <p class="fs-6 fw-bold">Pending</p>
                                                </div>
                                                    <i class="fas fa-clock fa-2x p-1 me-2" style="color: #800;"></i>
                                                
                                    </div>
                                </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="card-header bg-transparent border-0">
                                <div class="float-end mx-2">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#filterTrainingModal" class="btn-secondary text-uppercase fw-bold text-white rounded-3 shadow text-lg px-3 py-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>
                                </div>
                            </div>
                                    
                                

                            <div class="card-body pb-5">
                                <div class="table-responsive rounded-3 text-center text-small">
                                    <table class="table table-striped align-middle border-secondary border border-5 table-hover ">
                                        <thead class="text-dark shadow table align-middle" style="background-color:#FEFCFF;">
                                            <tr>
                                                @if ($table != "My Trainings")
                                                    <th scope="col">Name</th>
                                                @endif
                                                
                                                <th scope="col" class="">Certificate Title</th>
                                                <th scope="col">Date Covered</th>
                                                <th scope="col" class="">No. of Hours</th>
                                                <th scope="col">Venue</th>
                                               
                                                <th scope="col">Status</th>
                                                <th scope="col" style="color:  #800">Attendance Report</th>
                                                <th scope="col" style="color:  #800">Training Certificate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($trainings as $training)
                                                <tr>
                                                    @if ($table != "My Trainings")
                                                        <td class="fw-bold">{{$training->name}}</td>
                                                    @endif
                                                    <td class="fw-bold">{{$training->certificate_title}}</td>
                                                    <td>{{ $training->date_covered.' '.$training->specify_date }}</td>
                                                     <td>{{$training->num_hours }}</td> 
                                                    <td>{{$training->venue }}</td> 
                                                
                                                   
                                                    <td>
                                                        @if ($training->status == 'Approved')
                                                            <p class="badge badge-pill fs-6 bg-success text-white">Approved</p>
                                                        @endif
                                                        @if ($training->status == 'Not Submitted')
                                                            <p class="badge badge-pill fs-6 text-white" style="background-color: #800">Ongoing</p>
                                                        @endif
                                                        @if ($training->status == 'Rejected')
                                                            <p class="badge badge-pill fs-6 bg-danger text-white">Disapprove</p>
                                                        @endif
                                                        @if ($training->status == 'Pending')
                                                        <p class="badge badge-pill fs-6 bg-warning text-dark">Pending</p>
                                                        @endif
                                                    </td>
                                                    
 
                                                    <td>
                                                        <div class="btn-group dropstart">
                                                            <button type="button" class="btn btn-light rounded-3 border-2 border-secondary shadow-lg text-uppercase fw-bold " data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FEFCFF;">
                                                              Actions<i class="fas fa-ellipsis-v ms-2"></i>
                                                            </button>
                                                            <ul class="dropdown-menu rounded-3 shadow-lg">
                                                                @if ($training->attendance_form == 0)
                                                            
                                                                    
                                                                        <li><button type="button" wire:click="createAttendanceForm({{$training->training_id}})" class="btn-danger text-danger rounded-3 text-uppercase dropdown-item">
                                                                            <i class="fas fa-pen me-2"></i>Create</button></li>

                                                                @else


                                                                            <li><button type="button" wire:click="showAttendanceForm({{$training->training_id}})" data-bs-toggle="modal" data-bs-target="#viewAttModal" class="btn-success text-success rounded-3 text-uppercase dropdown-item my-2" ><i class="fas fa-eye me-2"></i>View</button></li>

                                                                            <li><button type="button" data-bs-toggle="modal" data-bs-target="#printAttendanceModal" wire:click="signature({{$training->training_id}})" class="btn-info text-primary rounded-3 text-uppercase dropdown-item my-2">
                                                                                <i class="fas fa-download me-2"></i>Download</button></li>
                    
                                                                        @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')
                                                                            <li><button type="button" wire:click="editAttendanceForm({{$training->training_id}})" class="btn-info text-primary rounded-3 text-uppercase dropdown-item my-2">
                                                                                <i class="fas fa-edit me-2"></i>Edit</button></li>

                                                                            <li><button type="button" data-bs-toggle="modal" data-bs-target="#deleteAttendanceModal" wire:click="deleteAttendanceForm({{$training->training_id}})" class="text-danger rounded-3 text-uppercase dropdown-item my-2">
                                                                                <i class="fas fa-trash me-2"></i>Delete</button></li>
                                                                        @endif
                                                                    
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </td>

                                                    
                                                    <td>
                                                        <div class="btn-group dropstart">
                                                            <button type="button" class="btn btn-light rounded-3 shadow-lg border-2 border-secondary text-uppercase fw-bold text-dark" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FEFCFF;">
                                                              Actions   <i class="fas fa-ellipsis-v ms-2"></i>
                                                            </button>
                                                            <ul class="dropdown-menu rounded-3 shadow-lg">
                                                                @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')
                                                                    @if ($training->attendance_form == 1) 
                                                                        <li><button type="button" data-bs-toggle="modal" data-bs-target="#submitTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-success text-success rounded-3 text-uppercase dropdown-item my-2">
                                                                            <i class="fas fa-paper-plane me-2"></i>Submit</button></li>
                                                                    @endif
                                                                
                                                                @endif
                                                            
                                                            <li><button type="button" wire:click="show({{$training->training_id}})" data-bs-toggle="modal" data-bs-target="#viewTrainingModal" class="btn-success text-success rounded-3 text-uppercase dropdown-item my-2">
                                                                <i class="fas fa-eye me-2"></i>View</button>
                                                            <li><button type="button" data-bs-toggle="modal" data-bs-target="#showTrainingModal" wire:click="certificate({{$training->training_id}})" class="btn-info text-primary rounded-3 text-uppercase  dropdown-item my-2" >
                                                                <i class="fas fa-certificate me-2"></i>Certificate</button></li>
                                                                
                                                                @if ($training->comment)
                                                                <li><button type="button" data-bs-toggle="modal" data-bs-target="#showCommentModal" wire:click="showComment({{$training->training_id}})" class="btn-info text-primary rounded-3 text-uppercase dropdown-item my-2">
                                                                    <i class="fas fa-comments me-2"></i>Comment</button></li>
                                                                @endif

                                                            

                                                                
                                                            @if ($training->status != 'Approved')
                                                            
                                                            
                                                                    @if ($training->status == 'Pending')
                                                                        @if (auth()->user()->role_as == 1)
                                                                        <li><button type="button" data-bs-toggle="modal" data-bs-target="#approveTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-success text-success rounded-3 text-uppercase dropdown-item my-2">
                                                                            <i class="fas fa-thumbs-up me-2"></i>Approve</button></li>

                                                                        <li><button type="button" data-bs-toggle="modal" data-bs-target="#rejectTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-danger text-danger rounded-3  text-uppercase dropdown-item my-2">
                                                                            <i class="fas fa-thumbs-down me-2"></i>Disapprove</button></li>
                                                                        @endif    
                                                                    @endif
                                                                
                                                            

                                                                    @if($training->status != 'Pending')
                                                                    <li><button type="button" wire:click="edit({{$training->training_id}})" class="btn-primary text-primary rounded-3 text-uppercase dropdown-item my-2">
                                                                        <i class="fas fa-edit me-2"></i>Edit</button></li>
                                                                        <li><button type="button" data-bs-toggle="modal" data-bs-target="#deleteTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-danger text-danger rounded-3 text-uppercase dropdown-item my-2">
                                                                            <i class="fas fa-trash me-2"></i>Delete</button></li>
                                                                    @endif
                                                                    
                                                                    
                                                                        
                                                                    
                                                                        
                                                                        @if ($training->status == 'Pending')
                                                                            @if (auth()->user()->role_as == 0)
                                                                            <li><button type="button" data-bs-toggle="modal" data-bs-target="#removeSubmissionTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-danger text-danger rounded-3 fw-light text-uppercase dropdown-item my-2">
                                                                                <i class="fas fa-undo-alt me-1"></i>Cancel Submission</button></li>
                                                                            @endif    
                                                                        @endif
                                                                @endif
                                                            </ul>
                                                        
                                                    </td>
                                                </tr>
                                            </div>
                                        </div>
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
                document.getElementById('main-card').style.paddingRight = '10%';
           
            }else{
                document.getElementById('main-card').className = 'w-100';
                document.getElementById('main-card').style.paddingRight = '0%';
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
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
        
    
</script>
    @endsection
    
</div>


    
    

