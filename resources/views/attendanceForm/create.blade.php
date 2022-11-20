<div class="card-header">
    <div class="fw-bolder fs-3 float-start text-uppercase">
        Create Attendance Report    
    </div>
</div>
<div class="card-body">

        @if ($next == 0)
            @include('attendanceForm.part.part1')
        @endif
        @if ($next == 1)
            @include('attendanceForm.part.part2')
            <div class="float-end gap-2">
            <button type="button" class="btn btn-secondary" wire:click="back">Back</button>
            <button type="button" class="btn btn-danger" wire:click="backButton"
                 data-bs-dismiss="modal">Close</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#createConfirmationAttendanceModal" class="btn btn-primary "><i class="fas fa-save me-2"></i>Save</button>
            </div>
        @endif         

</div>
