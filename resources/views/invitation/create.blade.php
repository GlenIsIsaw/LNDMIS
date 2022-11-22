
    <div class="card-header">
        <div class="fw-bold fs-3 text-uppercase">
            Upload Training    
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="fw-bold">Name</label>
            <input type="text" wire:model="name" class="form-control border border-3 border-secondary mt-2 ms-5" style="width: 80%">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label class="fw-bold">Date</label>
            <input type="date" wire:model="date" class="form-control border border-3 border-secondary ms-5 mt-2" style="width: 80%">
            @error('date') <span class="text-danger">{{ $message }}</span> @enderror
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
                <input type="file" wire:model="file" accept="image/*,.pdf" class="form-control border border-3 border-secondary ms-5 mt-2" style="width: 80%">
                <div wire:loading wire:target="file">
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
                
            </div>
            @error('file') <span class="text-danger">{{ $message }}</span> @enderror
        
        </div> 
                <div class="mt-3">
                    <hr class="h-color mx-2 mt-3">
                <div class="float-end">
               
                <button type="button"  wire:click="backButton" class="btn btn-danger rounded-3 px-3 py-2 text-center me-1">Close</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#createConfirmationInvitationModal" class="btn btn-primary rounded-3 px-3 py-2 text-center"><i class="fas fa-save me-2"></i>Save</button>
                </div>
                </div>
                

    </div>
