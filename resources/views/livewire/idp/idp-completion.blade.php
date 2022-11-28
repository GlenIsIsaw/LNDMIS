

<div>
    @include('livewire.menu')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card">
                    <div class="card" >
                        <div class="card-header">
                          
                            <div class="fw-bolder fs-3 float-start text-uppercase"> IDP Completion Rate </div>
                            <select wire:model='year' class="border border-3 fs-4 ms-1 px-1 fw-bold border-dark rounded-3 mb-2">
                                <option value=""></option>
                                @for ($i = date('Y') + 1; $i >= 2015; $i--)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                           
    
                            </select>
                       
                            
                          
                            <input type="search" wire:model="name" class="form-control float-end border-3 py-2" placeholder="Search by Name" style="width: 265px" />
                        </div>
                        <div class="card-body">
                            <button type="button"style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle mx-2 my-2" wire:click="resetFilter"><i class='fas fa-redo'></i></button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#printIdpCompModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 px-3 fw-bold py-2 mx-2" style="background-color: #800;"><i class="fas fa-download me-2"></i>Download</button>
                                
                                
                          
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive border-secondary border-3 text-center">
                                <table class="table table-hover table-bordered border border-5 border-secondary table align-middle">
                                    <thead class="text-dark align-bottom shadow" style="background-color:#FEFCFF;">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Progress</th>
                                            <th scope="col">Competency</th>
                                            <th scope="col">Number of Trainings</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($competencies as $idp)
                                            <tr>
                                                <td rowspan="4" class="fw-bold fs-5">{{$idp['name']}}</td>
                                                <td rowspan="4"><span class="badge text-white fs-6 px-4 py-3" style="background-color: #800">{{$progress[$idp['progress']]}}</span></td>
                                                @foreach ($idp['competency'] as $comp => $count)
                                            </tr>
                                            <tr>
                                                <td class="text-uppercase fw-bold fs-5">{{$comp}}</td>
                                                <td class="fw-bold fs-5">{{$count}}</td>
                                                @endforeach
                                                
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('livewire.idp.idp-completion-modal')
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

                $('#printIdpCompModal').modal('hide');
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



