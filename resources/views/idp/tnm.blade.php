<div class="card-header">
    <div class="float-start my-2 fw-bold text-uppercase fs-4">
    
        Training Needs Assessment
   
    </div>
    
    <div class="float-end my-2">
        <button data-bs-toggle="modal" data-bs-target="#printTnmModal" class="btn-secondary text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-2 py-2 mx-2" style="background-color: #800;"><i class="fas fa-download me-2"></i>Download TNM Reports</button>
        <button type="button" class="btn btn-danger" wire:click="backButton"><i class="fas fa-times px-1 pt-2"></i></button>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th class="fw-bold text-uppercase">Target Competency</th>
                <th class="fw-bold text-uppercase">Count</th>
            </tr>
            @forelse ($competencies as $comp => $count)
                <tr>
                    <td>{{$comp}}</td>
                    <td class="fw-bold">{{$count}}</td>
                </tr>
            @empty
                <tr>No Records</tr>
            @endforelse
                <tr>
                    <th>Total</th>
                    <th><span class="badge bg-success text-white fs-6 px-3 py-2">{{array_sum($competencies)}}</span></th>
                </tr>
        </table>
    </div>
</div>