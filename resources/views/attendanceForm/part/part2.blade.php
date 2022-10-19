<div class="justify-content-center">
   
    <div class="progress" style="height:25px; mx-4">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
          
        </div>
      </div>
</div>

<hr class="h-color mx-2 mt-3">
<div class="mb-3">
    <label class="fw-bold">Outcome</label>
    <textarea wire:model="outcome" rows="4" cols="50" class="form-control border border-3 border-secondary"></textarea>
    @error('outcome') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Personal Action</label>
    <textarea wire:model="personal_action" rows="4" cols="50" class="form-control border border-3 border-secondary"></textarea>
    @error('personal_action') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<button type="button" class="btn btn-secondary" wire:click="back">Back</button>


<button type="button" class="btn btn-danger" wire:click="backButton"
    data-bs-dismiss="modal">Close</button>


