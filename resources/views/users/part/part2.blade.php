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
    <input type="text" wire:model.lazy="position" class="form-control border border-3 border-dark rounded-3">
    @error('position') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label>Year In Position</label>
    <input type="date" wire:model.lazy="yearinPosition" class="form-control border border-3 border-dark rounded-3">
    @error('yearinPosition') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label>Year Joined</label>
    <input type="date" wire:model.lazy="yearJoined" class="form-control border border-3 border-dark rounded-3">
    @error('yearJoined') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<div class="float-end">

</div>
<div class="float-end">
    <!--<button type="button" class="btn btn-danger rounded-3" wire:click="backButton">Close</button>
     <button type="button" wire:click="next" class="btn btn-primary">Next</button> -->
</div>