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
                        <div class="card-head mt-2">
                        
                            <div>

                                    <button type="submit" data-bs-toggle="modal" data-bs-target="#addCollegeModal" class="float-end btn-success rounded-3 px-2 py-1 me-3 text-uppercase fw-bold" style="background-image: linear-gradient(
                                        to bottom, #52c234,
                                         #061700);"><i class="fas fa-plus me-1"></i>Add</button>
                                    <input type="text" wire:model.lazy="college_name" class="form-control float-end mx-2" placeholder="Add College Department" style="width: 230px" />
                            </div>
                        
                        
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive rounded-3">
                        
                                <table class="table table align-middle mb-0 bg-white border border-secondary border-3 table-striped table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>ID</th>
                                            <th class="ps-5">College Name</th>
                                            <th>Coordinator</th>
                                            <th>Supervisor</th>
                                            <th>Action</th>
                                        </tr>
                        
                                    </thead>
                                    <tbody>
                                        @forelse ($colleges as $college)
                                            <tr>
                                                <td>
                                                    
                                                {{$college->id}}

                                                           
                                            
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center ms-5">
                                                        <img
                                                            src="/images/cnsc.png"
                                                            alt=""
                                                            style="width: 55px; height: 55px"
                                                            class="rounded-circle"
                                                            />
                                                            <div class="ms-3">
                                                  <p class="fw-bold mb-1 text-uppercase">  {{$college->college_name}} </p>
                                                  <p class="text-muted mb-0">Camarines Norte State College</p>
                                                
                                                </div>
                                            </div>
                                                </td>
                                                <td>{{$this->get($college->coordinator)}}</td>
                                                <td>{{$this->get($college->supervisor)}}</td>
                                                <td>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#editCollegeModal" wire:click="edit({{$college->id}})" class="btn btn-link text-uppercase rounded-3 shadow-lg fw-bold px-3 py-2" style="color: #800"><i class="fas fa-pen me-1"></i>Edit</button>
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
