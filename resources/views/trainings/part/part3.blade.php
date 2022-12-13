
@if ($state == 'editTraining')
<div class="form-check form-switch mb-3 text-uppercase fw-bold">
    <input  class="form-check-input" type="checkbox" wire:model="editCert" >
        Edit the Current Certificate
</div>

@else
    @php
        $editCert = 1;
    @endphp
@endif

@if ($editCert)
    <div class="mb-3">
        <label class="fw-bold">Attach the Certificate</label><span class="text-danger fw-bold">*</span>
        
            <input type="file" wire:model="photo" accept=".jpeg,.png,.jpg,.svg,.pdf" class="form-control border border-3 border-secondary">
            <div wire:loading wire:target="photo">Uploading...</div>
        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
    
    </div> 
@endif


