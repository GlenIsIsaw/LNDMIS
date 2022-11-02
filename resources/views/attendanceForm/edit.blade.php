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

            <div class="float-end">
            <button type="button" data-bs-toggle="modal" data-bs-target="#editConfirmationAttendanceModal" class="btn btn-primary mx-2">Save</button>
            </div>
        @endif   
    </form>
</div>
