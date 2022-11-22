

<div>
    @include('livewire.menu')
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12">
                @if ($state)
                <div id="main-card">
                    <div class="card">
                        @if($state == 'create')
                            @include('invitation.create')
                        @endif
                        @if($state == 'show')
                            @include('invitation.show')
                        @endif
                    </div>
                </div>

                @else
                <div id="main-card">
                    <div class="card" >
                        <div class="card-header">
                                <div class="fw-bolder fs-3 float-start text-uppercase">Incoming Invitations for Trainings</div>
                                <button type="button"style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle mt-2" wire:click="resetFilter"><i class='fas fa-redo'></i></button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#filterInvitationModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>

                            
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive rounded-3 text-center">
                                <table class="table table-striped border border-secondary border-5 table-hover">
                                    <thead class="text-dark" style="background-color:#FEFCFF;">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date Covered</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        @forelse ($trainings as $training)
                                            <tr>
                                                <td class="fw-bold">{{$training->name}}</td>
                                                <td>{{$training->date}}</td>
                                                <td>
                                                    <button type="button" wire:click="show({{$training->id}})">
                                                         View File
                                                    </button>
                                                    @if (auth()->user()->role_as == 1)
                                                    <button type="button" wire:click="editAttendanceForm({{$training->id}})" class="btn-info text-light rounded-3 shadow-lg fw-bold text-uppercase px-4 py-2" style="background-image: linear-gradient(
                                                        to bottom, #000046, 
                                                        #1CB5E0);"><i class="fas fa-edit"></i><br>Edit</button>

                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteInvitationModal" wire:click="deleteAttendanceForm({{$training->id}})" class="btn-danger text-white rounded-3 fw-bold px-3 py-2 text-uppercase" style="background-image: linear-gradient(
                                                        to bottom, #870000,
                                                        #190A05);"><i class="fas fa-trash fa-sm"></i><br>Delete</button>
                                                    @endif
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
                @endif
            </div>
        </div>
    </div>


    @include('livewire.invitation-modal')
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

            $('#printfileModal').modal('hide');
            
            

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





