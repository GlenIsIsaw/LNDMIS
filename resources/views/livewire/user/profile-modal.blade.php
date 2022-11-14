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
                    <div class="mb-3 fw-bold">
                        <label>Current Password</label>
                        <input type="password" wire:model="current_password" class="form-control border-dark border-2">
                        @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3 fw-bold">
                        <label>New Password</label>
                        <input type="password" wire:model="password" class="form-control border-dark border-2">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3 fw-bold">
                        <label>Confirm New Password</label>
                        <input type="password" wire:model="password_confirmation" class="form-control border-dark border-2">
                        @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closePass"
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
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Save Input</button>
                </div>
            </form>
        </div>
    </div>
</div>