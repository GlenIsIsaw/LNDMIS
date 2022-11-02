

<div>
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card" style="padding-right: 5%">
                    <div class="card" >
                        <div class="card-header">
                            
                            <div class="fw-bolder fs-3 float-start text-uppercase"> Trainings Summary </div>
                                <button type="button"style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle" wire:click="resetFilter"><i class='fas fa-redo'></i></button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#filterSummaryTrainingModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#printTrainingModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 px-2 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-print me-2"></i>Print</button>

                            
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive table-bordered text-center">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Certificate Title</th>
                                            <th scope="col">Certificate Type</th>
                                            <th scope="col">Date Covered</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Number of Hours</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">Sponsors</th>
                                            <th scope="col">Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($trainings as $training)
                                            <tr>
                                                <td>{{$training->name}}</td>
                                                <td>{{$training->certificate_title}}</td>
                                                <td>{{$training->certificate_type}}</td>
                                                <td>{{ $training->date_covered }}</td>
                                                <td>{{ $training->level }}</td>
                                                <td>{{ $training->num_hours }}</td>
                                                <td>{{ $training->venue }}</td>
                                                <td>{{ $training->sponsors }}</td>
                                                <td>{{ $training->type }}</td>

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


    @include('livewire.training.training-summary')
@include('livewire.main-modal')
</div>



