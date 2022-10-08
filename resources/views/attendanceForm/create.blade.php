<div class="card-header">
	<h4>
        Create Attendance Form    
    </h4>
</div>
<div class="card-body">
    <form wire:submit.prevent="storeAttendanceForm">
        @if ($next == 0)
            @include('attendanceForm.part.part1')
        @endif
        @if ($next == 1)
            @include('attendanceForm.part.part2')
        @endif         
    </form>
</div>
