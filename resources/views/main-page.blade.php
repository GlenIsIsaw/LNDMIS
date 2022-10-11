@extends('layouts.app')

@section('content')

<div>
    <livewire:main />
</div>

@section('script')
<script>
    window.addEventListener('closeIdp-modal', event => {

        $('#deleteIdpModal').modal('hide');
        $('#submitIdpModal').modal('hide');
        $('#printIdpModal').modal('hide');
        $('#approveIdpModal').modal('hide');
        $('#rejectIdpModal').modal('hide');
        $('#removeSubmissionIdpModal').modal('hide');
    })

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

</script>
@endsection
@endsection