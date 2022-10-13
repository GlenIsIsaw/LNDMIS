<div class="card">
    <div class="card-header">
        <h4>
            Update {{$certificate_title}}   
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
                <div class="d-flex bd-highlight">
                    <div class="p-2 flex-fill bd-highlight">
                        <label for="current">Current Certificate</label>
                        <img class="img-thumbnail img-fluid rounded float-start" id="current" width="200" height="200" src="{{ url('storage/users/'.$name.'/'.$certificate) }}">
                    </div>
                    <div class="p-2 flex-fill bd-highlight">
                        @if ($photo)
                        <label for="uploaded">Uploaded Photo:</label>
                        <img class="img-thumbnail img-fluid rounded float-end" id="uploaded" width="200" height="200" src="{{ $photo->temporaryUrl() }}">
                        @endif
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" wire:click="back">Back</button>
                <div class="float-end gap-2">
                <button type="button" class="btn btn-danger" wire:click="backButton">Close</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#editConfirmationTrainingModal" class="btn btn-primary">Update</button>
                </div>
                @endif
                

    </div>
</div>