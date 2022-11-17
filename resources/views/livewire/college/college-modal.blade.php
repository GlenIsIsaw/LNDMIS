<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteCollegeModal" tabindex="-1" aria-labelledby="deleteCollegeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCollegeModalLabel">Delete College</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetInput"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="delete">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this college?</h4>
                    <p>Deleting it may erase all data related to this college.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="resetInput"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="editCollegeModal" tabindex="-1" aria-labelledby="editCollegeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCollegeModalLabel">Update College</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetInput"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body">
                    <input type="text" wire:model.lazy="college_name" class="form-control" placeholder="Edit College" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="resetInput"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="addCollegeModal" tabindex="-1" aria-labelledby="addCollegeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCollegeModalLabel">Add College</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetInput"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                    <h6>Are you sure you want to add {{$this->college_name}}?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="resetInput"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes!</button>
                </div>
            </form>
        </div>
    </div>
</div>