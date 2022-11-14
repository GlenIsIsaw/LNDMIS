

<div>
    @include('livewire.menu')
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card">
                    <div class="card" >
                        <div class="card-header">
                           
                                <div class="fw-bolder fs-3 float-start text-uppercase">Training Certificates Summary</div>
                                <button type="button"style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle mt-2" wire:click="resetFilter"><i class='fas fa-redo'></i></button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#filterSummaryCertificateModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#printCertificateModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-download me-2"></i>Download</button>

                            
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive table-bordered text-center">
                                <table class="table table-striped border-dark table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Certificate Title</th>
                                            <th scope="col">Date Covered</th>
                                            <th scope="col">Certificate</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($trainings as $training)
                                            <tr>
                                                <td>{{$training->name}}</td>
                                                <td>{{$training->certificate_title}}</td>
                                                <td>{{$training->date_covered}}</td>
                                                <td>
                                                    @php
                                                        $array = explode(".", $training->certificate);
                                                        $ext =  strtolower(end($array));
                                                    @endphp
                                                    @if ($ext == "pdf")
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#showCertificateModal" wire:click="show({{$training->training_id}})">
                                                            View Pdf
                                                        </button>
                                                    @else
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#showCertificateModal" wire:click="show({{$training->training_id}})">
                                                            <img class="img-thumbnail img-fluid rounded-3" id="current" width="200" height="200" src="{{ url('storage/users/'.$training->user_id.'/'.$training->certificate) }}?{{ rand() }}">
                                                        </button>
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
            </div>
        </div>
    </div>


    @include('livewire.training.certificate-summary')
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

            $('#printCertificateModal').modal('hide');
            
            

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




