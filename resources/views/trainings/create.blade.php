
    <div class="card-header">
        <h4>
            Upload Training    
        </h4>
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
                @if ($photo)
                Uploaded Photo:
                <img class="img-fluid rounded mx-auto d-block" width="500" height="500" src="{{ $photo->temporaryUrl() }}">
                @endif

                <div class="mt-3">
                <button type="button" wire:click="back" class="btn btn-secondary rounded-3 px-3 py-2 text-center">Back</i></button>

                <hr class="h-color mx-2 mt-3">
                <div class="float-end">
                <button type="button"  wire:click="backButton" class="btn btn-danger">Close</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#createConfirmationTrainingModal" class="btn btn-primary">Save</button>
                </div>
                </div>
            @endif
                

    </div>
