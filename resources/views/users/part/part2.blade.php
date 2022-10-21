<div class="justify-content-center mt-4">

    <div class="progress" style="height:25px; mx-4">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
          
        </div>
      </div>
</div>

<hr class="h-color mx-2 mt-3">


<div class="mb-3">
    <label>Position</label>
    <input type="text" wire:model="position" class="form-control">
    @error('position') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label>Year In Position</label>
    <input type="date" wire:model="yearinPosition" class="form-control">
    @error('yearinPosition') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label>Year Joined</label>
    <input type="date" wire:model="yearJoined" class="form-control">
    @error('yearJoined') <span class="text-danger">{{ $message }}</span> @enderror
</div>


<button type="button" wire:click="back" class="btn btn-secondary rounded-3 px-3 py-2 text-center">Back</i></button>

<div class="float-end">
    <!--<button type="button" class="btn btn-danger rounded-3" wire:click="backButton">Close</button>
     <button type="button" wire:click="next" class="btn btn-primary">Next</button> -->
</div>