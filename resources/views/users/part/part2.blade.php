<div class="justify-content-center mt-4">

   
</div>




<div class="mb-3">
    <label  class="fw-bold">Position</label><span class="text-danger fw-bold">*</span>
    <input type="text" wire:model.lazy="position" class="form-control border border-3 border-dark rounded-3">
    @error('position') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label  class="fw-bold">Year In Position</label><span class="text-danger fw-bold">*</span>
    <input type="date" wire:model.lazy="yearinPosition" class="form-control border border-3 border-dark rounded-3">
    @error('yearinPosition') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label  class="fw-bold">Year Joined</label><span class="text-danger fw-bold">*</span>
    <input type="date" wire:model.lazy="yearJoined" class="form-control border border-3 border-dark rounded-3">
    @error('yearJoined') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<div class="float-end">

</div>
<div class="float-end">
    <!--<button type="button" class="btn btn-danger rounded-3" wire:click="backButton">Close</button>
     <button type="button" wire:click="next" class="btn btn-primary">Next</button> -->
</div>