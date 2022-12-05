
<div class="mb-3">
    <label class="fw-bold">Free</label><span class="text-danger fw-bold">*</span>
    <select wire:model="free" class="form-control border border-3 border-secondary" style="width:100%">
        <option value="">Pick Yes or No</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select>
    
    @if ($free == 'No')
        <label class="fw-bold mt-2 ms-3">Amount:</label><span class="text-danger fw-bold">*</span>
        <input type="number" wire:model.lazy="amount" class="form-control border border-3 border-secondary rounded-3 ms-5" style="width:70%;">
    @endif
    @error('free') <span class="text-danger">{{ $message }}</span> @enderror
    @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<div class="mb-3">
    <label class="fw-bold">Date Covered</label><span class="text-danger fw-bold">*</span>
    <input type="text" wire:model.lazy="date_covered" class="form-control border border-3 border-secondary" style="width:100%">
    @error('date_covered') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Registration Deadline</label><span class="text-danger fw-bold">*</span>
    <input type="date" wire:model.lazy="date" class="form-control border border-3 border-secondary" style="width: 100%">
    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<hr class="h-color mx-2 mt-3">

<div class="float-end">
    <button type="button" wire:click="back" class="btn btn-secondary rounded-3 px-3 py-2 text-center me-1" id="back" wire:loading.attr="disabled">Back</button>
    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center me-1" wire:click="backButton">Close</button>
    <button type="button" wire:click="part2" class="btn btn-primary rounded-3 px-3 py-2 text-center" id="part2" wire:loading.attr="disabled">Next</button>
</div>