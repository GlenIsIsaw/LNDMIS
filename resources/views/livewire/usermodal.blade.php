
<div wire:ignore.self class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Create User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <form wire:submit.prevent="saveUser">
                <div class="modal-body">
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
                    <div class="mb-3">
                        <label>Position</label>
                        <input type="text" wire:model="position" class="form-control">
                        @error('position') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Year In Position</label>
                        <input type="date" wire:model="yearinPosition" class="form-control">
                        @error('yearinPosition') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Year Joined</label>
                        <input type="date" wire:model="yearJoined" class="form-control">
                        @error('yearJoined') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>
                            <input type="checkbox" wire:model="supervisor" value="1">
                            Supervisor
                        </label><br>
                        <h6>{{$supervisor}}</h6>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Update Modal -->
<div wire:ignore.self class="modal fade" id="updateuserModal" tabindex="-1" aria-labelledby="updateuserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateuserModalLabel">Edit user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="updateUser">
                <div class="modal-body">
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
                        <div class="mb-3">
                            <label>Position</label>
                            <input type="text" wire:model="position" class="form-control">
                            @error('position') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Year In Position</label>
                            <input type="date" wire:model="yearinPosition" class="form-control">
                            @error('yearinPosition') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Year Joined</label>
                            <input type="date" wire:model="yearJoined" class="form-control">
                            @error('yearJoined') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteuserModal" tabindex="-1" aria-labelledby="deleteuserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteuserModalLabel">Delete user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyUser">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this data ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit College Info -->
<div wire:ignore.self class="modal fade" id="collegeModal" tabindex="-1" aria-labelledby="collegeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="collegeModalLabel">Create User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <form wire:submit.prevent="updateCollege">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" wire:model="name" class="form-control">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Confirmation User Modal -->
<div wire:ignore.self class="modal fade" id="createConfirmationUserModal" tabindex="-1" aria-labelledby="createConfirmationUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createConfirmationUserModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="saveUser">
                <div class="modal-body">
                    <h6>Are you sure you want to save your input?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Save Input</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Confirmation User Modal -->
<div wire:ignore.self class="modal fade" id="editConfirmationUserModal" tabindex="-1" aria-labelledby="editConfirmationUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editConfirmationUserModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="updateUser">
                <div class="modal-body">
                    <h6>Are you sure you want to edit your User info?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Save Input</button>
                </div>
            </form>
        </div>
    </div>
</div>