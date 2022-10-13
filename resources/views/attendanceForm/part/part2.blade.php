<div class="d-flex justify-content-between">
   
    <h6>Part1-><b>Part2</b></h6>
    <p>&nbsp; </p>
</div>
<div class="mb-3">
    <label>Outcome</label>
    <textarea wire:model="outcome" rows="4" cols="50" class="form-control"></textarea>
    @error('outcome') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label>Personal Action</label>
    <textarea wire:model="personal_action" rows="4" cols="50" class="form-control"></textarea>
    @error('personal_action') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<button type="button" class="btn btn-secondary" wire:click="back">Back</button>
<button type="button" class="btn btn-danger" wire:click="backButton"
    data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save</button>
