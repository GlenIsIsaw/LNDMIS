
<div>
    @include('livewire.menu')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-12">
                @if ($state)
                <div id="main-card">
                    <div class="card">
                        @if($state == 'create')
                            @include('idp.create')
                        @endif
                        @if($state == 'edit')
                            @include('idp.edit')
                        @endif
                        @if($state == 'show')
                            @include('idp.show')
                        @endif
                    </div>
                </div>

                @else
                <div id="main-card">

                
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="fw-bold text-uppercase my-1">
                                {{$table}}
                                <button type="button" style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle my-1" wire:click="resetFilter"><i class='fas fa-redo' wire:click="resetInput"></i></button>
                                <input type="search" wire:model="search" class="form-control float-end mx-2 my-1 border-3" placeholder="Search by Name" style="width: 250px" />
                            </h3>
                        </div>

                        <div class="card-header mb-1 border-0">
                                @if ($table == 'My IDPs')
                                <div class="container-fluid px-5">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <div class="py-1 bg-white shadow-sm d-flex justify-content-around align-items-center rounded-3" style="background-color: #FEFCFF">
                                                <div>
                                        <h6 class="fs-2 fw-bolder" style="color: #926F34">{{$approved}}  </h6>
                                        <p class="fs-6 fw-bold">Approved </p>
                                                </div>
                                               <i class="fas fa-thumbs-up fa-2x p-1 me-2" style="color: #800;" ></i>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="py-1 px-1 bg-white shadow-sm d-flex justify-content-around align-items-center rounded-3" style="background-color: #FEFCFF">
                                                <div>
                                                    <h6 class="fs-2 fw-bolder" style="color: #926F34">  {{$rejected}} </h6> 
                                                    <p class="fs-6 fw-bold">Disapprove</p>
                                                </div>
                                                <i class="fas fa-thumbs-down fa-2x  p-1 me-2" style="color: #800;"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="py-1 px-1 bg-white shadow-sm d-flex justify-content-around align-items-center rounded-3" style="background-color: #FEFCFF">
                                                <div>
                                                    <h6 class="fs-2 fw-bolder" style="color: #926F34">  {{$notSubmitted}}  </h6>  
                                                    <p class="fs-6 fw-bold">Ongoing</p>
                                                </div>
                                                <i class="fas fa-times-circle fa-2x p-1 me-2" style="color: #800;"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="py-1 px-1 bg-white shadow-sm d-flex justify-content-around align-items-center rounded-3" style="background-color: #FEFCFF">
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
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#filterIdpModal"  class="btn-secondary text-uppercase fw-bold text-white rounded-3 shadow text-lg px-3 py-2 my-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>
                                    @if ($table == 'Submitted IDPs' || $table == 'Approved IDPs')
                                        @if ($idps->isNotEmpty())
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#printAllIdpModal"  class="btn-secondary text-uppercase fw-bold text-white rounded-3 shadow text-lg px-3 py-2 my-2" style="background-color: #800;"><i class="fas fa-download me-2"></i>Download All</button>
                                        @endif
                                        
                                    @endif
                              
                            </div>
                              
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive rounded-3">
                                <table class="table table-striped border border-5 border-secondary table-hover">
                                    <thead class="text-dark align-bottom shadow" style="background-color:#FEFCFF;">
                                        <tr class="table-bordered">
                                            @if ($table != 'My IDPs')
                                                <th scope="col">Name</th>
                                            @endif
                                            <th scope="col">Competency</th>
                                            <th scope="col">Completion Status</th>
                                            <th scope="col">Year</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Updated At</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" style="color:  #800">IDP Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($idps as $idp)

                                            <tr>
                                                @if ($table != 'My IDPs')
                                                    <td class="fw-bold">{{$idp->name}}</td>
                                                @endif
                                                <td>
                                                    <ol class="list-group list-group-numbered">
                                                        @foreach ($idp->competency as $item)
                                                            <li class="list-group-item">{{$item}}</li>
                                                        @endforeach
                                                    </ol>
                                                </td>
                                                <td>
                                                    <ol class="list-group list-group-numbered">
                                                        @foreach ($idp->status as $item)
                                                            <li class="list-group-item">{{$item}}</li>
                                                        @endforeach
                                                    </ol>
                                                </td>
                                                <td>{{ $idp->year }}</td>
                                                <td>{{ $idp->created_at }}</td>
                                                <td>{{ $idp->updated_at }}</td>
                                                <td>
                                                    @if ($idp->submit_status == 'Approved')
                                                    <p class="badge badge-pill fs-6 bg-success text-white">Approved</p>
                                                @endif
                                                @if ($idp->submit_status == 'Not Submitted')
                                                    <p class="badge badge-pill fs-6 text-white" style="background-color: #800">Ongoing</p>
                                                @endif
                                                @if ($idp->submit_status == 'Rejected')
                                                    <p class="badge badge-pill fs-6 bg-danger text-white">Disapprove</p>
                                                @endif
                                                @if ($idp->submit_status == 'Pending')
                                                <p class="badge badge-pill fs-6 bg-warning text-dark">Pending</p>
                                                @endif
                                                
                                                </td>
                                                <td>
                                                    <div class="d-grid gap-3 mx-3">
                                                   
                                                       @if ($idp->submit_status == 'Not Submitted' || $idp->submit_status == 'Rejected')
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#submitIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-success rounded-3 shadow-sm fw-bold px-3 py-2 text-uppercase" style="background-image: linear-gradient(
                                                                to top, #000000,
                                                                #0f9b0f);"><i class="fas fa-paper-plane me-1"></i>Submit</button>
                                                        @endif
                                                        <button type="button" wire:click="show({{$idp->idp_id}})" class="btn-success rounded-3 shadow-sm fw-bold text-white text-uppercase px-3 py-2" style="background-image: linear-gradient(
                                                            to bottom, #52c234,
                                                                    #061700);"><i class="fas fa-eye me-1"></i>View</button>
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#printIdpModal" wire:click="signature({{$idp->idp_id}})" class="btn-info text-white btn-sm rounded-3 shadow-sm fw-bold text-uppercase" style="background-image: linear-gradient(
                                                            to bottom, #43C6AC,
                                                                #191654); font-size:13px; padding:11px 11px 11px 11px;"><i class="fas fa-download me-1"></i>Download</button>
                                                        @if ($idp->comment)
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#showCommentModal" wire:click="showComment({{$idp->idp_id}})" class="btn-info text-white rounded-3 shadow text-uppercase fw-bold px-3 py-2" style="background-image: linear-gradient(
                                                                to bottom, #43C6AC,
                                                                #191654);"><i class="fas fa-comments me-1"></i>Comment</button>
                                                        @endif
                                                            
                                                   


                                                   @if ($idp->submit_status != 'Approved') 
                                                        @if ($idp->submit_status == 'Pending')
                                                            @if (auth()->user()->role_as == 1)
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#approveIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-success btn-sm text-white rounded-3 shadow fw-bold px-2 py-2 text-uppercase" style="background-image: linear-gradient(
                                                                    to top, #000000,
                                                                    #0f9b0f);"><i class="fas fa-thumbs-up me-1"></i>Approve</button>

                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#rejectIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-danger text-white rounded-3 shadow fw-bold px-2 py-2 text-uppercase" style="background-image: linear-gradient(
                                                                    to bottom, #870000,
                                                                    #190A05);"><i class="fas fa-thumbs-down me-1"></i>Reject</button>
                                                            @endif    
                                                        @endif

                                                            
                                                            @if($idp->submit_status != 'Pending')
                                                                <button type="button" wire:click="edit({{$idp->idp_id}})" class="btn-primary text-white rounded-3 text-uppercase shadow-sm fw-bold px-3 py-2" style="background-image: linear-gradient(
                                                                    to bottom, #000046, 
                                                                    #1CB5E0);"><i class="fas fa-edit me-1"></i>Edit</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-danger text-white text-uppercase rounded-3 shadow-sm px-3 fw-bold py-2" style="background-image: linear-gradient(
                                                                    to bottom, #870000,
                                                                    #190A05);"><i class="fas fa-trash fa-sm me-1"></i>Delete</button>
                                                            @endif

                                                            
                                                            @if ($idp->submit_status == 'Pending')
                                                                @if (auth()->user()->role_as == 0)
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#removeSubmissionIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-danger text-white rounded-3 shadow-sm px-3 fw-bold py-2 px-3 text-uppercase" style="background-image: linear-gradient(
                                                                        to bottom, #870000,
                                                                        #190A05);"><i class="fas fa-trash"></i><br>Remove Submission</button>
                                                                @endif    
                                                            @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10">No Record Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <div class="d-flex justify-content-center">
                                {{ $idps->links() }}
                            </div>
                        </div>
                    </div>
                    </div>
                @endif
            </div>
        </div>
        @include('livewire.idp.idp-modal')
        @include('livewire.main-modal')
        @section('script')
    <script>

        window.addEventListener('toggle', event => {
            if(document.getElementById("wrapper").classList.contains('toggled')){

                document.getElementById('main-card').className = 'vw-100';
                document.getElementById('main-card').style.paddingRight = '8%';
               
            }else{
                document.getElementById('main-card').className = 'w-100';
                document.getElementById('main-card').style.paddingRight = '0%';
            }
        })
        window.addEventListener('close-modal', event => {
  
            $('#deleteIdpModal').modal('hide');
            $('#submitIdpModal').modal('hide');
            $('#printIdpModal').modal('hide');
            $('#approveIdpModal').modal('hide');
            $('#rejectIdpModal').modal('hide');
            $('#removeSubmissionIdpModal').modal('hide');
            $('#createConfirmationIdpModal').modal('hide');
            $('#editConfirmationIdpModal').modal('hide');
            $('#printSummaryIdpModal').modal('hide');
            $('#printAllIdpModal').modal('hide');
            


            
            

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


