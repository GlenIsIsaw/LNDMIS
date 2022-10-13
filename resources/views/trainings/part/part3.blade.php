<div class="d-flex justify-content-between">
    
    <h6>Part1->Part2-><b>Part3</b></h6>
    <p> </p>
</div>
<div class="mb-3">
    <label>Attach the Certificate Photo</label>
    <div
    x-data="{ isUploading: false, progress: 0 }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
        <input type="file" wire:model="photo" accept="image/*" class="form-control">
        <div wire:loading wire:target="photo">
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>
        
    </div>
    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
</div> 

