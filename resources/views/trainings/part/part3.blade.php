<div class="justify-content-center">
    
    <div class="progress" style="height:25px; mx-4">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
          
        </div>
      </div>
</div>

<hr class="h-color mx-2 mt-3">
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

