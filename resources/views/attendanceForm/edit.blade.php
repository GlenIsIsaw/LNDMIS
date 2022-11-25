<div class="card-header">
    <div class="fw-bolder fs-3 float-start text-uppercase">
        Edit Attendance Form    
    </div>
</div>
<div class="card-body">
    <form wire:submit.prevent="updateAttendanceForm">
        @if ($next == 0)
            @include('attendanceForm.part.part1')
        @endif
        @if ($next == 1)
            @include('attendanceForm.part.part2')

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-secondary" wire:click="back" wire:loading.attr="disabled" id="back">Back</button>
            <button type="button" class="btn btn-danger" wire:click="backButton"
            data-bs-dismiss="modal">Close</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#editConfirmationAttendanceModal" class="btn btn-primary">Save</button>
            </div>
        @endif   
    </form>
</div>
