<div class="card-header">
    <div class="fw-bolder fs-3 float-start text-uppercase">
        Attendance Report
    </div>
    <div class="float-end">   
        <button type="button" class="btn btn-danger float-end" wire:click="backButton"><i class="fas fa-times fa-4"></i></button></div>
    
        
  

</div>
<div class="card-body table-responsive">
    <table class="table table-borderd table-striped table-responsive">
        <tbody class="table-responsive">
            <tr>
                <th style="width: 35%">Name</th>
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

   
</div>
