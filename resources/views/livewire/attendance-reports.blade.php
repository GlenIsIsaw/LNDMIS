<div>

    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card" style="padding-right: 5%">
                    <div class="card" >
                        <div class="card-header">
                            <h4>
                                Attendance Summary
                                <button type="button" style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle" wire:click="resetFilter"><i class='fas fa-redo'></i></button>
                                <button data-bs-toggle="modal" data-bs-target="#filterSummaryAttendanceModal" class="float-end mx-2">Filter</button>     
                                <button data-bs-toggle="modal" data-bs-target="#printSummaryAttendanceModal" class="float-end mx-2">Print</button>                  
                            </h4>
                            
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive table-bordered text-center">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Intervention</th>
                                        <th>Date Conducted</th>
                                        <th>Venue</th>
                                        <th>Sponsors</th>
                                        <th>Competency</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($trainings as $training)
                                            <tr>
                                                <td>{{$count++}}</td>
                                                <td>{{$training->name}}</td>
                                                <td>{{$training->certificate_title}}</td>
                                                <td>{{$training->date_covered}}</td>
                                                <td>{{$training->venue}}</td>
                                                <td>{{$training->sponsors}}</td>
                                                <td>{{$training->competency}}</td>
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
    @include('livewire.attendance.attendance-modal')
    @include('livewire.main-modal')
</div>
