

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
                                    
                                

                            <div class="card-body">
                                <div class="table-responsive rounded-3 text-center text-small">
                                    <table class="table table-striped table-bordered align-middle border-secondary border border-5 table-hover ">
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
                                                <th scope="col" style="color:  #800">Attendance Report Actions</th>
                                                <th scope="col" style="color:  #800">Training Certificate Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($trainings as $training)
                                                <tr>
                                                    @if ($table != "My Trainings")
                                                        <td class="fw-bold">{{$training->name}}</td>
                                                    @endif
                                                    <td class="fw-bold">{{$training->certificate_title}}</td>
                                                    <td>{{ $training->date_covered.' : '.$training->specify_date }}</td>
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
                                                    
                                                    
                                                    @if ($training->attendance_form == 0)
                                                
                                                  
                                                           <td>
                                                            <button wire:click="createAttendanceForm({{$training->training_id}})" class="btn-danger text-white rounded-3 shadow-lg fw-bold text-uppercase tt" data-bs-placement="top" 
                                                                title="Create your Attendance Report by Pressing This Button."
                                                             style="background-image: linear-gradient(
                                                                to bottom, #870000,
                                                                #190A05);"><i class="fas fa-pen"></i></button>
                                                           </td>
                                                    @else
                                                        <td>
                                                            <div class="d-grid gap-2 d-md-block">

                                                                <button type="button" wire:click="showAttendanceForm({{$training->training_id}})" class="btn-success btn-floating text-white rounded-3 shadow-lg fw-bold text-uppercase  tt" data-bs-placement="top" 
                                                                    title="Show the Attendance Report By Clicking This Button." style="background-image: linear-gradient(
                                                                    to bottom, #52c234,
                                                                    #061700);"><i class="fas fa-eye"></i></button>

                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#printAttendanceModal" wire:click="signature({{$training->training_id}})" class="btn-info text-white rounded-3 shadow-lg fw-bold text-uppercase" data-bs-placement="top" 
                                                                    title="Download the Attendance Report By Clicking This Button." style="background-image: linear-gradient(
                                                                     to bottom, #43C6AC,
                                                                #191654);"><i class="fas fa-download"></i></button>
                                                            
                                                            @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')

                                                            
  
                                                          
                                                                <button class="btn btn-link"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                data-bs-placement="top" 
                                                                    title="Some Actions Are Here" data-bs-auto-close="outside" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v fa-lg" style="color:  #800;"></i>
                                                                </button>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">   
                                                                    <li><a href="#" wire:click="editAttendanceForm({{$training->training_id}})" class="dropdown-item fw-bold" data-bs-placement="top" 
                                                                    title="Edit the Attendance Report By Clicking This Button."><i class="fas fa-pen me-2"></i>Edit</a></li>

                                                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#deleteAttendanceModal" wire:click="deleteAttendanceForm({{$training->training_id}})"  class="dropdown-item fw-bold" data-bs-placement="top" 
                                                                    title="Delete the Attendance Report By Clicking This Button." style="color: #800"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                                                </ul>
                                                           
                                                            @endif
                                                            </div>
                                                        </td>
                                                   
                                                    @endif
                                                    </div>

                                                    
                                                    <td>
                                                        <div class="d-grid gap-2 d-md-block">
                                                            @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')
                                                            @if ($training->attendance_form == 1) 
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#submitTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-success text-white rounded-3 shadow text-uppercase fw-bold"  data-bs-placement="top" 
                                                                    title="Submit the Certificate Of Your Training To The Coordinator By Clicking This Button." style="background-image: linear-gradient(
                                                                    to top, #000000,
                                                                    #0f9b0f);"><i class="fas fa-paper-plane"></i></button>
                                                            @endif
                                                        
                                                        @endif
                                                        </div>
                                                        <div class="d-grid gap-2 d-md-block mt-2">    
                                                    <button type="button" wire:click="show({{$training->training_id}})" class="btn-success text-white rounded-3 shadow-lg fw-bold text-uppercase"  data-bs-placement="top" 
                                                        title="Show The Full Information Of The Certificate By Clicking This Button." style="background-image: linear-gradient(
                                                        to bottom, #52c234,
                                                        #061700);"><i class="fas fa-eye"></i></button>

                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#showTrainingModal" wire:click="certificate({{$training->training_id}})" class="btn-info text-white rounded-3 fw-bold text-uppercase" data-bs-placement="top" 
                                                                title="Show The Certificate Of Your Training By Clicking This Button." style="background-image: linear-gradient(
                                                                to bottom, #43C6AC,
                                                                #191654);"><i class="fas fa-certificate"></i></button>
                                                          
                                                          <button class="btn btn-link"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                          data-bs-placement="top" 
                                                              title="Some Actions Are Here" data-bs-auto-close="outside" aria-expanded="false">
                                                              <i class="fas fa-ellipsis-v fa-lg" style="color:  #800;"></i>
                                                          </button>
                                                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"> 
                                                          @if ($training->comment)
                                                          <li><a href="#" data-bs-toggle="modal" data-bs-target="#showCommentModal" wire:click="showComment({{$training->training_id}})" class="dropdown-item text-Capitalize fw-bold" data-bs-placement="top" 
                                                            title="Show the Comment Written & Given By Your Coordinator By Clicking This Button." ><i class="fas fa-comments me-2"></i>Comment</a></li>
                                                      @endif

                                                       

                                                        
                                                       @if ($training->status != 'Approved')
                                                       
                                                       <div class="d-grid gap-2 d-md-block">
                                                        @if ($training->status == 'Pending')
                                                            @if (auth()->user()->role_as == 1)
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#approveTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-success  text-white rounded-3 mt-2 shadow-sm fw-bold text-uppercase" data-bs-placement="top" 
                                                                    title="Approve The Submitted Certificate By Clicking This Button."  style="background-image: linear-gradient(
                                                                    to top, #000000,
                                                                    #0f9b0f);"><i class="fas fa-thumbs-up"></i></button>

                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#rejectTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-danger text-white rounded-3 shadow-sm fw-bold mt-2 text-uppercase"  data-bs-placement="top" 
                                                                    title="Disapprove The Submitted Certificate By Clicking This Button."  style="background-image: linear-gradient(
                                                                    to bottom, #870000,
                                                                    #190A05);"><i class="fas fa-thumbs-down"></i></button>
                                                            @endif    
                                                        @endif
                                                   </div>
                                                     
                                                      
                                                    

                                                            @if($training->status != 'Pending')
                                                                <button type="button" wire:click="edit({{$training->training_id}})" class="btn-primary rounded-3 shadow fw-bold text-uppercase"  data-bs-placement="top" 
                                                                    title="Edit The Information Of Your Training Certificate By Clicking This Button." style="background-image: linear-gradient(
                                                                    to bottom, #000046, 
                                                                    #1CB5E0);"><i class="fas fa-edit"></i></button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-danger text-white rounded-3 shadow-sm fw-bold text-uppercase"  data-bs-placement="top" 
                                                                    title="Delete Your Training Certificate By Clicking This Button."  style="background-image: linear-gradient(
                                                                    to bottom, #870000,
                                                                    #190A05"><i class="fas fa-trash"></i></button>
                                                            @endif
                                                            
                                                            
                                                            
                                                                
                                                               
                                                                
                                                                @if ($training->status == 'Pending')
                                                                    @if (auth()->user()->role_as == 0)
                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#removeSubmissionTrainingModal" wire:click="delete({{$training->training_id}})" class="btn-danger text-white rounded-3 shadow-sm fw-bold text-uppercase mt-2"
                                                                            data-bs-placement="top" 
                                                                            title="Cancel The Submission of Your Entry By Clicking This Button." style="background-image: linear-gradient(
                                                                            to bottom, #870000,
                                                                            #190A05);"><i class="fas fa-times-circle"></i></button>
                                                                    @endif    
                                                                @endif


                                                        @endif
                                                    </div>
                                                    </td>
                                                </tr>
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


    
    

