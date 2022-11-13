
<div>
    @include('livewire.menu')
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12 mr-3">
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
                                <h6>QEM</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-bordered text-center">
                                    <table class="table table-bordered border-dark table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Title of Intervention</th>
                                                <th scope="col">Competency</th>
                                                <th scope="col">Date Conducted</th>
                                                <th scope="col">Venue</th>
                                                <th scope="col">Sponsors</th>
                                                <th class="text-danger"scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($trainings as $training)
                                                <tr>
                                                    <td>{{$training->name}}</td>
                                                    <td>{{$training->certificate_title}}</td>
                                                    <td>{{$training->trainCompetency}}</td>
                                                    <td>{{$training->date_covered}}</td>
                                                    <td>{{$training->venue}}</td>
                                                    <td>{{$training->sponsors}}</td>
                                                    <td>
                                                        @if ($training->qem == 0)
                                                            <button type="button" wire:click="createButton({{$training->training_id}})" class="btn-light text-white rounded-3 shadow-lg fw-bold text-uppercase px-3 py-2" style="background-image: linear-gradient(
                                                                to bottom, #870000,
                                                                #190A05);"><i class="fas fa-pen"></i><br>Create</button>
                                                        @else
                                                            <button type="button" wire:click="show({{$training->training_id}})" class="btn-light text-white rounded-3 shadow-lg fw-bold text-uppercase px-3 py-2" style="background-image: linear-gradient(
                                                                to bottom, #870000,
                                                                #190A05);"><i class="fas fa-pen"></i><br>Show</button>
                                                            
                                                            <button type="button" wire:click="edit({{$training->training_id}})" class="btn-light text-white rounded-3 shadow-lg fw-bold text-uppercase px-3 py-2" style="background-image: linear-gradient(
                                                                to bottom, #870000,
                                                                #190A05);"><i class="fas fa-pen"></i><br>Edit</button>
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteQemModal" wire:click="getId({{$training->training_id}})" class="btn-light text-white rounded-3 shadow-lg fw-bold text-uppercase px-3 py-2" style="background-image: linear-gradient(
                                                                to bottom, #870000,
                                                                #190A05);"><i class="fas fa-pen"></i><br>Delete</button>
                                                        @endif


                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">No Record Found</td>
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
                document.getElementById('main-card').style.paddingRight = '15%';
            }else{
                document.getElementById('main-card').className = 'w-100';
                document.getElementById('main-card').style.paddingRight = '0%';
            }
        })
        window.addEventListener('close-modal', event => {

            $('#editConfirmationQemModal').modal('hide');
            $('#createConfirmationQemModal').modal('hide');
            $('#deleteQemModal').modal('hide');
            

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



