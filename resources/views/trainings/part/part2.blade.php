<div class="d-flex justify-content-between">
    <button type="button" wire:click="back">Back</button>
    <h6>Part1-><b>Part2</b>->Part3</h6>
    <p>&nbsp; </p>
</div>
<div class="mb-3">
    <label>Venue</label>
    <input type="text" wire:model="venue" class="form-control">
    @error('venue') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label>Sponsors</label>
    <input type="text" wire:model="sponsors" class="form-control">
    @error('sponsors') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label>Number of Hours</label>
    <input type="number" wire:model="num_hours" class="form-control">
    @error('num_hours') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label>Type</label>
    <select wire:model="type" class="form-control">
        <option value="">...</option>
        <option value="Eligibility">Eligibility</option>
        <option value="Event-Facilitator">Event-Facilitator</option>
        <option value="Membership">Membership</option>
        <option value="Seminar">Seminar</option>
        <option value="Seminar-Facilitator">Seminar-Facilitator</option>
    </select>
    @error('type') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<button type="button" class="btn btn-secondary" wire:click="backButton">Close</button>
<button type="button" wire:click="next" class="btn btn-primary">Next</button>


