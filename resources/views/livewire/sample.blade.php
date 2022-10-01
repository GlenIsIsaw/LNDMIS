<div>
    <form wire:submit.prevent="saveUser">
        <div class="modal-body">
               <div class="form-group">
                    <label>Name</label>
                    <input type="text" wire:model="name" class="form-control">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" wire:model="email" class="form-control">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" wire:model="position" class="form-control">
                    @error('position') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Year In Position</label>
                    <input type="date" wire:model="yearinPostion" class="form-control">
                    @error('yearinPosition') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Year Joined</label>
                    <input type="date" wire:model="yearJoined" class="form-control">
                    @error('yearJoined') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>College</label>
                    <input type="text" wire:model="college" class="form-control">
                    @error('college') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Supervisor</label>
                    <input type="text" wire:model="supervisor" class="form-control">
                    @error('supervisor') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" wire:click="closeModal"
                data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
