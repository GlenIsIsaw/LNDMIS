<div class="mb-3">
    <label class="fw-bold">Training Title</label><span class="text-danger fw-bold">*</span>
    <input type="text" wire:model.lazy="name" class="form-control border border-3 border-secondary" style="width: 100%">
    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Sponsor</label><span class="text-danger fw-bold">*</span>
    <input type="text" wire:model.lazy="sponsor" class="form-control border border-3 border-secondary" style="width: 100%">
    @error('sponsor') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Venue</label><span class="text-danger fw-bold">*</span>
    <input type="text" wire:model.lazy="venue" class="form-control border border-3 border-secondary" style="width: 100%">
    @error('venue') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Level</label><span class="text-danger fw-bold">*</span>
    <select wire:model="level" class="form-control border border-3 border-secondary" style="width: 100%">
        
        <option value="{{$level}}">{{$level}}</option>
        <option value="">Choose One</option>
        <option value="International">International</option>
        <option value="Local">Local</option>
        <option value="N/A">N/A</option>
        <option value="National">National</option>
        <option value="Regional">Regional</option>
        <option value="Others">Others</option>
    </select>
    @if ($level == 'Others')
        <label class="fw-bold mt-2 ms-3">Specify The Level:</label><span class="text-danger fw-bold">*</span>
        <input type="text" wire:model.lazy="level_others" class="form-control border border-3 border-secondary rounded-3" style="width:50%;">
        
    @endif
    @error('level_others') <span class="text-danger">{{ $message }}</span> @enderror
    @error('level') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<hr class="h-color mx-2 mt-3">
<div class="float-end">
    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center me-1" wire:click="backButton">Close</button>
    <button type="button" wire:click="part1" class="btn btn-primary rounded-3 px-3 py-2 text-center" id="part1" wire:loading.attr="disabled">Next</button>   
</div>
