@if($state == 'edit')
<label>
    <input type="checkbox" wire:model="editFile" >
        Edit the Current Attached File
</label><br>

@else
    @php
        $editFile = 1;
    @endphp
@endif

@if ($editFile)
<div class="mb-3">
    <label class="fw-bold">Attach the Invitation</label><span class="text-danger fw-bold">*</span>

        <input type="file" wire:model="file" accept="image/*,.pdf" class="form-control border border-3 border-secondary ms-5 mt-2" style="width: 80%">
        <div wire:loading wire:target="file">Uploading...</div>
    @error('file') <span class="text-danger">{{ $message }}</span> @enderror
</div>
@endif
