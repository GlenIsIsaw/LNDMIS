

<div>
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card" style="padding-right: 5%">
                    <div class="card" >
                        <div class="card-header">
                           
                                <div class="fw-bolder fs-3 float-start text-uppercase">Training Certificates Summary</div>
                                <button type="button"style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle" wire:click="resetFilter"><i class='fas fa-redo'></i></button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#filterSummaryCertificateModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#printCertificateModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-print me-2"></i>Print</button>

                            
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
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#showCertificateModal" wire:click="show({{$training->training_id}})">
                                                        <img class="img-thumbnail img-fluid rounded" id="current" width="200" height="200" src="{{ url('storage/users/'.$training->user_id.'/'.$training->certificate) }}?{{ rand() }}">
                                                    </button>
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
</div>




