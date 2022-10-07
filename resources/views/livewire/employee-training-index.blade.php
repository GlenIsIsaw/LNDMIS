


<div>
    @include('livewire.menu')
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12 mr-3">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>
                            @if (auth()->user()->role_as == 1)
                                <select class="border border-info border-3 rounded" wire:model="table">
                                    <option value="Approved Trainings">Approved Trainings</option>
                                    <option value="My Trainings">My Trainings</option>
                                    <option value="Submitted Trainings">Submitted Trainings</option>
                                </select>
                            @else
                                My Trainings
                            @endif
                            
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#createTrainingModal">
                                Add New Training
                            </button>
                            
                            
                        </h4>
                        
                    </div>

                    
                        <div class="card-header bg-transparent border-0">
                            
                            
                            <div class="float-end mx-2">
                                <label>Sort By</label>
                                <select wire:model="filterStatus" class="text-center text-center border border-dark border-2 rounded">
                                    <option value="All">Default</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Not Submitted">Not Submitted</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="Pending">Pending</option>
                                  </select>
                            </div>
                            </div>
                            
                        

                          <div class="card-body">
                        <div class="table-responsive table-bordered text-center">
                            <table class="table table-striped table-hover">
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
                                            <td class="text-break">{{ $training->date_covered }}</td>
                                            <td>{{ $training->level }}</td>
                                            <td class="text-break">{{ $training->num_hours }}</td>
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
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteTrainingModal" wire:click="delete({{$training->training_id}})" class="btn btn-danger mx-2">Delete</button>
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
