<div class="card-header">
    <div class="fw-bolder fs-3 float-start text-uppercase">
        Create Attendance Form    
    </div>
</div>
<div class="card-body">

        @if ($next == 0)
            @include('attendanceForm.part.part1')
        @endif
        @if ($next == 1)
            @include('attendanceForm.part.part2')
            <div class="float-end">
            <button type="button" data-bs-toggle="modal" data-bs-target="#createConfirmationAttendanceModal" class="btn btn-primary">Save</button>
            </div>
        @endif         

</div>
