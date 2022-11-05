<div class="justify-content-center">

    <div class="progress" style="height:25px; mx-auto">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
          
        </div>

       

      </div>
</div>


      

<hr class="h-color mx-2 mt-3">
<div class="mb-3">
    <label class="fw-bold">Venue</label>
    <input type="text" wire:model="venue" class="form-control border border-3 border-secondary">
    @error('venue') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label  class="fw-bold">Sponsors</label>
    <input type="text" wire:model="sponsors" class="form-control border border-3 border-secondary">
    @error('sponsors') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Number of Hours</label>
    <input type="number" wire:model="num_hours" class="form-control border border-3 border-secondary">
    @error('num_hours') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Type</label>
    <select wire:model="type" class="form-control border border-3 border-secondary">
        <option value="">...</option>
        <option value="Eligibility">Eligibility</option>
        <option value="Event-Facilitator">Event-Facilitator</option>
        <option value="Membership">Membership</option>
        <option value="Seminar">Seminar</option>
        <option value="Seminar-Facilitator">Seminar-Facilitator</option>
    </select>
    @error('type') <span class="text-danger">{{ $message }}</span> @enderror
</div>



<hr class="h-color mx-2 mt-3">

<div class="float-end">
<button type="button" wire:click="back" class="btn btn-secondary rounded-3 px-3 py-2 text-center me-1">Back</button>
<button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center me-1" wire:click="backButton">Close</button>
<button type="button" wire:click="next" class="btn btn-primary rounded-3 px-3 py-2 text-center">Next</button>
</div>


