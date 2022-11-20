<div class="card-header">
    <div class="float-start my-2">
    <h4>
        Training Needs Assessment
    </h4>
    </div>
    
    <div class="float-end my-2">
        <button data-bs-toggle="modal" data-bs-target="#printTnmModal" class="btn-secondary text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-download me-2"></i>Download TNM Reports</button>
        <button type="button" class="btn btn-danger" wire:click="backButton"><i class="fas fa-times px-2 py-1"></i></button>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Target Competency</th>
                <th>Count</th>
            </tr>
            @forelse ($competencies as $comp => $count)
                <tr>
                    <td>{{$comp}}</td>
                    <td>{{$count}}</td>
                </tr>
            @empty
                <tr>No Records</tr>
            @endforelse
                <tr>
                    <th>Total</th>
                    <th>{{array_sum($competencies)}}</th>
                </tr>
        </table>
    </div>
</div>