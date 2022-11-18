<div>
    @include('livewire.menu')
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12 mr-3">
                <div id="main-card">
                    <div class="card">
                        <div class="card-header">
                            <div class="fw-bold fs-4 text-uppercase">
                                Colleges
                                
                            </div>
                        
                        </div>
                        <div class="card-body">
                        
                            <div>

                                    <button type="submit" data-bs-toggle="modal" data-bs-target="#addCollegeModal" class="float-end mx-2">Add</button>
                                    <input type="text" wire:model.lazy="college_name" class="form-control float-end mx-2" placeholder="Add College" style="width: 230px" />
                            </div>
                        
                        
                        
                            
                            <div class="table-responsive rounded-3 table-bordered text-center">
                        
                                <table class="table table-bordered border border-secondary border-3 table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>College Name</th>
                                            <th>Coordinator</th>
                                            <th>Supervisor</th>
                                            <th>Action</th>
                                        </tr>
                        
                                    </thead>
                                    <tbody>
                                        @forelse ($colleges as $college)
                                            <tr>
                                                <td>{{$college->id}}</td>
                                                <td>{{$college->college_name}}</td>
                                                <td>{{$this->get($college->coordinator)}}</td>
                                                <td>{{$this->get($college->supervisor)}}</td>
                                                <td>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#editCollegeModal" wire:click="edit({{$college->id}})" class="btn-info text-white text-uppercase rounded-3 shadow-lg fw-bold px-3 py-2" style="background-image: linear-gradient(
                                                        to bottom, #000046, 
                                                        #1CB5E0);"><i class="fas fa-pen"></i><br>Edit</button>
                                                </td>
                                            </tr>
                                        @empty
                                            
                                        @endforelse

                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.college.college-modal')
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

            $('#deleteCollegeModal').modal('hide');
            $('#editCollegeModal').modal('hide');
            $('#addCollegeModal').modal('hide');
            
            

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
