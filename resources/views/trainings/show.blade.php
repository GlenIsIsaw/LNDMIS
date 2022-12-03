<div class="card-header">
    <div class="fw-bolder fs-3 float-start text-uppercase">
        {{$certificate_title}}
    </div>
    <div class="float-end">   
        <button type="button" class="btn btn-danger float-end" wire:click="backButton"><i class="fas fa-times fa-4"></i></button></div>
    
        
  

</div>
<div class="card-body table-responsive">
    <table class="table table-borderd table-striped table-responsive">
        <tbody class="table-responsive">
            @if ($table != 'My Trainings')
                <tr>
                    <th>Name</th>
                    <td>{{$name}}</td>
                </tr>
            @endif
            <tr>
                <th>Certificate Type</th>
                <td>{{$certificate_type}}</td>
            </tr>
            <tr>
                <th>Certificate Title</th>
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
            <tr>
                <th>Number of Hours</th>
                <td>{{$num_hours}}</td>
            </tr>
            <tr>
                <th>Level</th>
                <td>{{$level}}</td>
            </tr>
            <tr>
                <th>Type</th>
                <td>{{$type}}</td>
            </tr>
        </tbody>
    </table>
</div>

   
</div>
