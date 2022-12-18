
<div>
    @include('livewire.menu')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card">
                    @if ($state)
                        <div class="card">
                            @if($state == 'create')
                                @include('qem.create')
                            @endif

                            @if($state == 'edit')
                                @include('qem.edit')
                            @endif

                            @if($state == 'show')
                                @include('qem.show')
                            @endif
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <h3 class="fw-bold text-uppercase align-bottom mt-2">{{$table}}

                                
                                <button type="button" style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle" wire:click="resetFilter"><i class='fas fa-redo'></i></button>
                            </h3>
                            </div>
                                <div class="card-header bg-transparent border-0">
                                    <div class="float-end mx-2">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#filterQemModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2 my-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>
                                @if ($table == 'Approved QEM')
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#printAllQemModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2 my-2" style="background-color: #800;"><i class="fas fa-download me-2"></i>Download All</button>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#printQemReportsModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2 my-2" style="background-color: #800;"><i class="fas fa-file-download me-2"></i>Download QEM Reports</button>
                                @endif
                                    </div>
                                </div>
                            
                            <div class="card-body">
                                <div class="table-responsive rounded-3 text-center">
                                    <table class="table table align-middle border border-5 border-secondary table-striped table-hover">
                                        <thead class="text-dark align-bottom" style="background-color:#FEFCFF;">
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Title of Intervention</th>
                                                <th scope="col">Competency</th>
                                                <th scope="col">Date Conducted</th>
                                                <th scope="col">Venue</th>
                                                <th scope="col">Sponsors</th>
                                                @if ($table != 'Training Need QEM')
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Date Created</th>
                                                @endif

                                                <th scope="col" style="color: #800">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($trainings as $training)
                                                <tr>
                                                    <td class="fw-bold">{{$training->name}}</td>
                                                    <td class="fw-bold"> 
                                                       {{$training->certificate_title}}
                                                    </td>
                                                    <td>{{$training->trainCompetency}}</td>
                                                    <td>{{$training->date_covered}}</td>
                                                    <td>{{$training->venue}}</td>
                                                    <td>{{$training->sponsors}}</td>
                                                    @if ($table != 'Training Need QEM')
                                                        <td>
                                                        @if ($training->confirmation_status == 'Approved')
                                                        <p class="badge badge-pill fs-6 bg-success text-white">Approved</p>
                                                    @endif
                                                    @if ($training->confirmation_status == 'Not Submitted')
                                                        <p class="badge badge-pill fs-6 text-white" style="background-color: #800">Ongoing</p>
                                                    @endif
                                                    @if ($training->confirmation_status == 'Rejected')
                                                        <p class="badge badge-pill fs-6 bg-danger text-white">Rejected</p>
                                                    @endif
                                                    @if ($training->confirmation_status == 'Pending')
                                                    <p class="badge badge-pill fs-6 bg-warning text-dark">Pending</p>
                                                </td>
                                                    @endif
                                                        <td>{{$training->date_created}}</td>
                                                    @endif

                                                    <td>
                                                        <div class="btn-group dropstart">
                                                            <button type="button" class="btn btn-light rounded-3 shadow-lg fw-bold border-2 border-secondary text-uppercase" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #FEFCFF;">
                                                                <i class="fas fa-caret-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                            @if ($training->qem == 0)
                                                                <li><button type="button" wire:click="createButton({{$training->training_id}})" class="btn-danger text-danger rounded-3 text-uppercase my-2 dropdown-item">
                                                                    <i class="fas fa-pen me-2"></i>Create</button></li>
                                                            @else
                                                                @if ($table != 'Training Need QEM')
                                                                    @if ($training->confirmation_status == 'Not Submitted')
                                                                    <li><button type="button" data-bs-toggle="modal" data-bs-target="#submitQemModal" wire:click="getQemId({{$training->qem_id}})" class="btn-success dropdown-item text-success rounded-3 my-2 text-uppercase">
                                                                        <i class="fas fa-paper-plane me-2"></i>Submit</button></li>
                                                                    @endif
                                                                    @if ($training->confirmation_status == 'Pending')
                                                                    <li><button type="button" data-bs-toggle="modal" data-bs-target="#approveQemModal" wire:click="getQemId({{$training->qem_id}})" class="btn-success dropdown-item text-success rounded-3 text-uppercase my-2">
                                                                        <i class="fas fa-thumbs-up me-2"></i>Approve</button></li>
                                                                    @endif
                                                                @endif
                                                                <li><button type="button" wire:click="show({{$training->qem_id}})" class="btn-info text-primary rounded-3 text-uppercase my-2 dropdown-item">
                                                                    <i class="fas fa-eye me-2"></i>Show</button></li>
                                                                
                                                                <li><button type="button" wire:click="edit({{$training->qem_id}})" class="btn-info text-primary rounded-3 text-uppercase my-2 dropdown-item">
                                                                    <i class="fas fa-edit me-2"></i>Edit</button></li>
                                                                <li><button type="button" data-bs-toggle="modal" data-bs-target="#deleteQemModal" wire:click="getQemId({{$training->qem_id}})" class="btn-danger dropdown-item text-danger rounded-3 my-2 text-uppercase">
                                                                    <i class="fas fa-trash me-2"></i>Delete</button></li>
                                                                <li><button type="button" data-bs-toggle="modal" data-bs-target="#printQemModal" wire:click="getQemId({{$training->qem_id}})" class="btn-info dropdown-item text-dark rounded-3 my-2 text-uppercase">
                                                                    <i class="fas fa-download me-2"></i>Download</button></li>
                                                            @endif

                                                            </ul>
                                                        </div>
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
                                <div>
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
    </div>
     

    @include('livewire.main-modal')
    @include('livewire.qem.qem-modal')

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

            $('#editConfirmationQemModal').modal('hide');
            $('#createConfirmationQemModal').modal('hide');
            $('#deleteQemModal').modal('hide');
            $('#submitQemModal').modal('hide');
            $('#approveQemModal').modal('hide');
            $('#printQemModal').modal('hide');
            $('#printAllQemModal').modal('hide');
            $('#printQemReportsModal').modal('hide');
            

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



