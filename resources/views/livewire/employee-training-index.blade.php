
@include('livewire.menu')

<div>
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12 mr-3">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif

                <div class="card">
                    <div class="card-header">
                        
                        <h4>Trainings
                            
                            
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#createTrainingModal">
                                Add New Training
                            </button>
                            
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="row">
                            <div class="col">
                                <label>Start Date</label>
                                <input type="date" wire:model="start_date" class="mx-auto my-2">
                        
                                
                                <label>End Date</label>
                                <input type="date" wire:model="end_date" class="mx-1">
                            </div>
                            
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col">
                                <label>Sort By</label>
                                <select wire:model="filterStatus" class="dropdown" style="width:150px">
                                    <option value="All">All</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Not Submitted">Not Submitted</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="Pending">Pending</option>
                                  </select>
                            </div>
                            
                          </div>
                        </div>  

                          <div class="card-body">
                        <div class="table-responsive text-center">
                            <table class="table table-borderd table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Certificate Title</th>
                                        <th scope="col">Date Covered</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Number of Hours</th>
                                        <th scope="col">Venue</th>
                                        <th scope="col">Sponsors</th>
                                        <th scope="col">Attendance Report</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($trainings as $training)
                                        <tr>
                                            <td>{{$training->name}}</td>
                                            <td><button type="button" data-bs-toggle="modal" data-bs-target="#showTrainingModal" wire:click="show({{$training->training_id}})" class="btn btn-link">{{$training->certificate_title}}</button></td>
                                            <td>{{ $training->date_covered }}</td>
                                            <td>{{ $training->level }}</td>
                                            <td>{{ $training->num_hours }}</td>
                                            <td>{{ $training->venue }}</td>
                                            <td>{{ $training->sponsors }}</td>
                                            @if ($training->attendance_form == 0)
                                                <td><button type="button" data-bs-toggle="modal" data-bs-target="#createAttendanceModal" wire:click="createAttendanceForm({{$training->training_id}})" class="btn btn-warning">Create Attendance Report</button></td>
                                            @else
                                                <td><button type="button" data-bs-toggle="modal" data-bs-target="#showAttendanceModal" wire:click="showAttendanceForm({{$training->training_id}})" class="btn btn-primary">View Attendance Report</button></td>
                                            @endif
                                            <td>{{ $training->status }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#updateTrainingModal" wire:click="edit({{$training->training_id}})" class="btn btn-primary">Edit</button>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteTrainingModal" wire:click="delete({{$training->training_id}})" class="btn btn-danger">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        
                                        <tr>
                                            <td colspan="10">No Record/s Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $trainings->links() }}
                        </div>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.training.training-modal')
    
</div>
