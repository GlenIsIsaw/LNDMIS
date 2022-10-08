@extends('layouts.app')

@section('content')

    <div>
        <livewire:training-show />
    </div>

        


@endsection

@section('script')
<script>
    window.addEventListener('close-modal', event => {

        $('#deleteTrainingModal').modal('hide');
        $('#updateTrainingModal').modal('hide');
        $('#deleteAttendanceModal').modal('hide');
        $('#printAttendanceModal').modal('hide');
        $('#updateAttendanceModal').modal('hide');
        $('#showAttendanceModal').modal('hide');
        $('#submitTrainingModal').modal('hide');
        $('#submitTrainingModal').modal('hide');
        $('#approveTrainingModal').modal('hide');
        $('#rejectTrainingModal').modal('hide');
        $('#removeSubmissionTrainingModal').modal('hide');
    })
    window.addEventListener('show-modal', event => {
        $('#submitTrainingModal').modal('hide');
        $('#removeSubmissionTrainingModal').modal('hide');
        $('#showTrainingModal').modal('show');
})

</script>
@endsection