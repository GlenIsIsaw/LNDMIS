
        <div class="mb-3">
            <label>Name</label>
            <input type="text" wire:model="name" class="form-control">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="text" wire:model="email" class="form-control">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label>Teacher</label>
            <select wire:model="teacher" class="form-control">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            @error('teacher') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="float-end">
            <button type="button" class="btn btn-danger rounded-3" wire:click="backButton">Close</button>
            <button type="button" wire:click="next" class="btn btn-primary">Next</button>
        </div>

