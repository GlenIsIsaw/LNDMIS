<div class="justify-content-center">
    
   
</div>


<div class="mb-3">
    <label class="fw-bold">Attach the Certificate</label>
    <div
    x-data="{ isUploading: false, progress: 0 }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
        <input type="file" wire:model="photo" accept="image/*" class="form-control border border-3 border-secondary">
        <div wire:loading wire:target="photo">
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>
        
    </div>
    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror

</div> 

