<div class="card-header">
	<h4>
        View Attendance Form    
    </h4>
</div>
<div class="card-body">
    <table class="table table-borderd table-striped">
        <tbody>
            <tr>
                <th>Name</th>
                <td>{{$name}}</td>
            </tr>
            <tr>
                <th>Title of Intervention Attended</th>
                <td>{{$certificate_title}}</td>
            </tr>
            <tr>
                <th>Date Conducted</th>
                <td>{{$date_covered}}</td>
            </tr>
            <tr>
                <th>Venue</th>
                <td>{{$venue}}</td>
            </tr>
            <tr>
                <th>Sponsors</th>
                <td>{{$sponsors}}</td>
            </tr>
                <th>Specific Competency to Develop/Enhance</th>
                <td>{{$competency}}</td>
            </tr>
            <tr>
                <th>Knowledge Acquired</th>
                <td>{{$knowledge_acquired}}</td>
            </tr>
            <tr>
                <th>Outcome</th>
                <td>{{$outcome}}</td>
            </tr>
            <tr>
                <th>Personal Action</th>
                <td>{{$personal_action}}</td>
            </tr>
        </tbody>
    </table>
</div>

    <div class="card-footer" style="float-end">
        <button type="button" class="btn btn-danger" wire:click="backButton">Close</button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#printAttendanceModal" wire:click="delete({{$ListOfTraining_id}})" class="btn btn-success">Print</button>
    </div>
</div>
