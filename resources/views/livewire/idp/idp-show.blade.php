
<div>
    @include('livewire.menu')
    <div class="container py-3 px-5">
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
                        <div class="card-header">
                            <h4>
                                {{$table}}
                                <button type="button" style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle" wire:click="resetFilter"><i class='fas fa-redo' wire:click="resetInput"></i></button>
                                <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search by Name" style="width: 230px" />
                            </h4>
                        </div>

                        <div class="card-header bg-transparent border-0">
                                @if ($table == 'My IDPs')
                                    <div class="mx-2">
                                        <h6>Approved: {{$approved}} ; Rejected: {{$rejected}} ; Not Submitted: {{$notSubmitted}} ; Pending: {{$pending}}</h6>
                                    </div>
                                @endif
                                
                                <div class="float-end mx-2">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#filterIdpModal"  class="btn-secondary text-uppercase fw-bold text-white rounded-3 shadow text-lg px-3 py-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>
                                    @if ($table == 'Submitted IDPs' || $table == 'Approved IDPs')
                                        @if ($idps->isNotEmpty())
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#printAllIdpModal"  class="btn-secondary text-uppercase fw-bold text-white rounded-3 shadow text-lg px-3 py-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Print All</button>
                                        @endif
                                        
                                    @endif
                                </div>
                        </div>

                        <div class="card-body text-center">
                            <div class="table-responsive table-bordered">
                                <table class="table table-striped table-bordered border border-5 border-secondary table-hover">
                                    <thead>
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
                                            <th scope="col" class="text-danger">IDP Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($idps as $idp)

                                            <tr>
                                                @if ($table != 'My IDPs')
                                                    <td>{{$idp->name}}</td>
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
                                                <td>{{ $idp->submit_status }}</td>
                                                <td>
                                                    <div class="d-grid gap-3 mx-3">
                                                   
                                                        @if ($idp->submit_status == 'Not Submitted' || $idp->submit_status == 'Rejected')
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#submitIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-success rounded-3 shadow-sm fw-bold px-3 py-2 text-uppercase" style="background-image: linear-gradient(
                                                                to top, #000000,
                                                                #0f9b0f);"><i class="fas fa-paper-plane"></i><br>Submit</button>
                                                        @endif
                                                        <button type="button" wire:click="show({{$idp->idp_id}})" class="btn-info rounded-3 shadow-sm fw-bold text-white text-uppercase px-5 py-2" style="background-image: linear-gradient(
                                                            to bottom, #43C6AC,
                                                            #191654);"><i class="fas fa-eye"></i><br>View</button>
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#printIdpModal" wire:click="signature({{$idp->idp_id}})" class="btn-success rounded-3 shadow-sm fw-bold text-uppercase px-3 py-2" style="background-image: linear-gradient(
                                                            to top, #000000,
                                                            #0f9b0f);"><i class="fas fa-print"></i><br>Print</button>
                                                        @if ($idp->comment)
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#showCommentModal" wire:click="showComment({{$idp->idp_id}})" class="btn-info text-white rounded-3 shadow text-uppercase fw-bold px-5 py-2" style="background-image: linear-gradient(
                                                                to bottom, #43C6AC,
                                                                #191654);"><i class="fas fa-comments"></i><br>Comment</button>
                                                        @endif
                                                            
                                                   


                                                     @if ($idp->submit_status != 'Approved')
                                                        @if ($idp->submit_status == 'Pending')
                                                            @if (auth()->user()->role_as == 1)
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#approveIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-success text-white rounded-3 shadow fw-bold px-5 py-2 text-uppercase" style="background-image: linear-gradient(
                                                                    to top, #000000,
                                                                    #0f9b0f);"><i class="fas fa-thumbs-up"></i><br>Approve</button>

                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#rejectIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-danger text-white rounded-3 shadow fw-bold px-5 py-2 text-uppercase" style="background-image: linear-gradient(
                                                                    to bottom, #870000,
                                                                    #190A05);"><i class="fas fa-thumbs-down"></i><br>Reject</button>
                                                            @endif    
                                                        @endif

                                                            
                                                            @if($idp->submit_status != 'Pending')
                                                                <button type="button" wire:click="edit({{$idp->idp_id}})" class="btn-primary text-white rounded-3 shadow-sm fw-bold px-3 py-2" style="background-image: linear-gradient(
                                                                    to bottom, #000046, 
                                                                    #1CB5E0);"><i class="fas fa-edit"></i><br>Edit</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-danger text-white rounded-3 shadow-sm px-3 fw-bold py-2" style="background-image: linear-gradient(
                                                                    to bottom, #870000,
                                                                    #190A05);"><i class="fas fa-trash fa-sm"></i><br>Delete</button>
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
                document.getElementById('main-card').style.paddingRight = '15%';
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


