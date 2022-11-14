<div class="card">
    <div class="card-header">
        <div class="fw-bold fs-5 text-uppercase">
            Update {{$certificate_title}}   
        </div>
        
    </div>
    <div class="card-body">
            @if ($next == 0)
                @include('trainings.part.part1')
            @endif
            @if ($next == 1)
                @include('trainings.part.part2')
            @endif
            @if ($next == 2)
                @include('trainings.part.part3')
                
                <div class="d-flex bd-highlight">
                    <div class="p-2 flex-fill bd-highlight">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#showTrainingModal" wire:click="show({{$ListOfTraining_id}})" class="btn-info text-white rounded-3 fw-bold text-uppercase text-center px-3 py-2" style="background-image: linear-gradient(
                            to bottom, #43C6AC,
                            #191654);"><i class="fas fa-certificate me-2"></i>Show Current Certificate</button>
                    </div>
                </div>
                <hr class="h-color mx-2 mt-3">
                <div class="float-end gap-2">
                <button type="button" class="btn btn-secondary" wire:click="back">Back</button>
                <button type="button" class="btn btn-danger" wire:click="backButton">Close</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#editConfirmationTrainingModal" class="btn btn-primary"><i class="fas fa-check me-2"></i>Update</button>
                </div>
                @endif
                

    </div>
</div>