
    <div class="card-header">
        <div class="fw-bold fs-5 text-uppercase">
            Upload Training    
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

                <div class="mt-3">
                    <hr class="h-color mx-2 mt-3">
                <div class="float-end">
                <button type="button" wire:click="back" class="btn btn-secondary rounded-3 px-3 py-2 text-center me-1">Back</i></button>
                <button type="button"  wire:click="backButton" class="btn btn-danger rounded-3 px-3 py-2 text-center me-1">Close</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#createConfirmationTrainingModal" class="btn btn-primary rounded-3 px-3 py-2 text-center"><i class="fas fa-save me-2"></i>Save</button>
                </div>
                </div>
            @endif
                

    </div>
