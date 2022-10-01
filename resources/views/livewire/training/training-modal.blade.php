<!-- Create Modal -->
<div wire:ignore.self class="modal fade" id="createTrainingModal" tabindex="-1" aria-labelledby="createTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTrainingModalLabel">Create Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label>Name</label>
                        <select wire:model="user_id" class="form-control">
                            <option value=""></option>
                            <option value="{{auth()->user()->id}}">{{auth()->user()->name}}</option>
                        </select>
                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Certificate Types</label>
                        <select type="text" wire:model="certificate_type" class="form-control">
                            <option value=""></option>
                                    <option value="Certificate of Eligibility">Certificate of Eligibility</option>
                                    <option value="Certificate of Training">Certificate of Training</option>
                                    <option value="Certificate of Appreciation">Certificate of Appreciation</option>
                                    <option value="Certificate of Attendance">Certificate of Attendance</option>
                                    <option value="Certificate of Commendation">Certificate of Commendation</option>
                                    <option value="Certificate of Completion">Certificate of Completion</option>
                                    <option value="Certificate of Participation">Certificate of Participation</option>
                                    <option value="Certificate of Recognition">Certificate of Recognition</option>
                                    <option value="Membership Certificate">Membership Certificate</option>
                        </select>
                        @error('certificate_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Certificate Name</label>
                        <input type="text" wire:model="certificate_title" class="form-control">
                        @error('certificate_title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Level</label>
                        <select wire:model="level" class="form-control">
                            <option value=""></option>
                            <option value="International">International</option>
                            <option value="Local">Local</option>
                            <option value="N/A">N/A</option>
                            <option value="National">National</option>
                            <option value="Regional">Regional</option>
                        </select>
                        @error('level') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Date Covered</label>
                        <input type="date" wire:model="date_covered" class="form-control">
                        @error('date_covered') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Venue</label>
                        <input type="text" wire:model="venue" class="form-control">
                        @error('venue') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Sponsors</label>
                        <input type="text" wire:model="sponsors" class="form-control">
                        @error('sponsors') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Number of Hours</label>
                        <input type="number" wire:model="num_hours" class="form-control">
                        @error('num_hours') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Type</label>
                        <select wire:model="type" class="form-control">
                            <option value=""></option>
                            <option value="Eligibility">Eligibility</option>
                            <option value="Event-Facilitator">Event-Facilitator</option>
                            <option value="Membership">Membership</option>
                            <option value="Seminar">Seminar</option>
                            <option value="Seminar-Facilitator">Seminar-Facilitator</option>
                        </select>
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Attach the Certificate Photo</label>
                        <input type="file" wire:model="photo" class="form-control">
                        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Update Modal -->
<div wire:ignore.self class="modal fade" id="updateTrainingModal" tabindex="-1" aria-labelledby="updateTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateTrainingModalLabel">Update {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label>Name</label>
                        <select wire:model="user_id" class="form-control">
                            <option value=""></option>
                            <option value="{{auth()->user()->id}}">{{auth()->user()->name}}</option>
                        </select>
                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Certificate Types</label>
                        <select type="text" wire:model="certificate_type" class="form-control">
                            <option value=""></option>
                                    <option value="Certificate of Eligibility">Certificate of Eligibility</option>
                                    <option value="Certificate of Training">Certificate of Training</option>
                                    <option value="Certificate of Appreciation">Certificate of Appreciation</option>
                                    <option value="Certificate of Attendance">Certificate of Attendance</option>
                                    <option value="Certificate of Commendation">Certificate of Commendation</option>
                                    <option value="Certificate of Completion">Certificate of Completion</option>
                                    <option value="Certificate of Participation">Certificate of Participation</option>
                                    <option value="Certificate of Recognition">Certificate of Recognition</option>
                                    <option value="Membership Certificate">Membership Certificate</option>
                        </select>
                        @error('certificate_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Certificate Name</label>
                        <input type="text" wire:model="certificate_title" class="form-control">
                        @error('certificate_title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Level</label>
                        <select wire:model="level" class="form-control">
                            <option value=""></option>
                            <option value="International">International</option>
                            <option value="Local">Local</option>
                            <option value="N/A">N/A</option>
                            <option value="National">National</option>
                            <option value="Regional">Regional</option>
                        </select>
                        @error('level') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Date Covered</label>
                        <input type="date" wire:model="date_covered" class="form-control">
                        @error('date_covered') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Venue</label>
                        <input type="text" wire:model="venue" class="form-control">
                        @error('venue') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Sponsors</label>
                        <input type="text" wire:model="sponsors" class="form-control">
                        @error('sponsors') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Number of Hours</label>
                        <input type="number" wire:model="num_hours" class="form-control">
                        @error('num_hours') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Type</label>
                        <select wire:model="type" class="form-control">
                            <option value=""></option>
                            <option value="Eligibility">Eligibility</option>
                            <option value="Event-Facilitator">Event-Facilitator</option>
                            <option value="Membership">Membership</option>
                            <option value="Seminar">Seminar</option>
                            <option value="Seminar-Facilitator">Seminar-Facilitator</option>
                        </select>
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Attach the Certificate Photo</label>
                        <input type="file" wire:model="photo" class="form-control">
                        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                        <img class="img-fluid" src="{{ url('storage/users/'.$name.'/'.$certificate) }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Show Modal -->
<div wire:ignore.self class="modal fade" id="showTrainingModal" tabindex="-1" aria-labelledby="showTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTrainingModalLabel">Show {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <div class="modal-body">
                    <table class="table table-borderd table-striped">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{$name}}</td>
                            </tr>
                            <tr>
                                <th>Certificate Type</th>
                                <td>{{$certificate_type}}</td>
                            </tr>
                            <tr>
                                <th>Certificate Title</th>
                                <td>{{$certificate_title}}</td>
                            </tr>
                            <tr>
                                <th>Level</th>
                                <td>{{$level}}</td>
                            </tr>
                            <tr>
                                <th>Venue</th>
                                <td>{{$venue}}</td>
                            </tr>
                            <tr>
                                <th>Sponsors</th>
                                <td>{{$sponsors}}</td>
                            </tr>
                            <tr>
                                <th>Date Covered</th>
                                <td>{{$date_covered}}</td>
                            </tr>
                            <tr>
                                <th>Number of Hours</th>
                                <td>{{$num_hours}}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>{{$type}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{$status}}</td>
                            </tr>
                            <tr>
                                <th>Attendance Form</th>
                                @if ($attendance_form == 0)
                                    <td><button type="button" data-bs-toggle="modal" data-bs-target="#createAttendanceModal" wire:click="edit({{$ListOfTraining_id}})" class="btn btn-warning">Create Attendance Report</button></td>
                                @else
                                    <td><button type="button" data-bs-toggle="modal" data-bs-target="#updateTrainingModal" wire:click="edit({{$ListOfTraining_id}})" class="btn btn-danger">View Attendance Report</button></td>
                                @endif
                            </tr>
                            <tr>
                                <th>Certificate</th>
                                <td><img class="img-fluid" src="{{ url('storage/users/'.$name.'/'.$certificate) }}"></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-toggle="modal" data-bs-target="#updateTrainingModal" wire:click="edit({{$ListOfTraining_id}})" class="btn btn-primary">Edit</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteTrainingModal" wire:click="delete({{$ListOfTraining_id}})" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" wire:click="closeModal"
                    data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteTrainingModal" tabindex="-1" aria-labelledby="deleteTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTrainingModalLabel">Delete {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroy">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this data ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>