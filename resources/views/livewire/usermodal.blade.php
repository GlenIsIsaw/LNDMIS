

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

<!-- Make Supervisor Confirmation -->
<div wire:ignore.self class="modal fade" id="supervisorModal" tabindex="-1" aria-labelledby="supervisorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="supervisorModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="makeSup">
                <div class="modal-body">
                    <h6>Are you sure you want make him/her a supervisor?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Make Not Supervisor Confirmation -->
<div wire:ignore.self class="modal fade" id="supervisorNotModal" tabindex="-1" aria-labelledby="supervisorNotModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="supervisorNotModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="makeNotSup">
                <div class="modal-body">
                    <h6>Are you sure you want to not make him/her a supervisor?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password User Modal -->
<div wire:ignore.self class="modal fade" id="changePassUserModal" tabindex="-1" aria-labelledby="changePassUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePassUserModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closePass"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="changePass">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Current Password</label>
                        <input type="password" wire:model="current_password" class="form-control">
                        @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>New Password</label>
                        <input type="password" wire:model="password" class="form-control">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Confirm New Password</label>
                        <input type="password" wire:model="password_confirmation" class="form-control">
                        @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closePass"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Save Input</button>
                </div>
            </form>
        </div>
    </div>
</div>

