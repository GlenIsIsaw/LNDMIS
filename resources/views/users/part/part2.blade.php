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
<div class="mb-3">
    <label>
        <input type="checkbox" wire:model="supervisor" value="1">
        Supervisor
    </label><br>
    <h6>{{$supervisor}}</h6>
</div>
<button type="button" wire:click="back" class="btn btn-secondary rounded-3 px-3 py-2 text-center">Back</i></button>

<div class="float-end">
    <!--<button type="button" class="btn btn-danger rounded-3" wire:click="backButton">Close</button>
     <button type="button" wire:click="next" class="btn btn-primary">Next</button> -->
</div>