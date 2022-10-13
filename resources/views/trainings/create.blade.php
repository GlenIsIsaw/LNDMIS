
    <div class="card-header">
        <h4>
            Create Training    
        </h4>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store">
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
                
                <div class="float-end">
                <button type="button" class="btn danger" wire:click="backButton">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            @endif
                </div>
        

        </form>
    </div>
