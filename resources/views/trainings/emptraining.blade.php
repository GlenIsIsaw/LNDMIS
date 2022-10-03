@extends('layouts.app')

@section('content')

    <div>
        <livewire:employee-training-index />
    </div>

@endsection

@section('script')
<script>
    window.addEventListener('close-modal', event => {

        $('#createTrainingModal').modal('hide');
        $('#deleteTrainingModal').modal('hide');
        $('#updateTrainingModal').modal('hide');
        $('#showTrainingModal').modal('hide');
        $('#createAttendanceModal').modal('hide');
        $('#deleteAttendanceModal').modal('hide');
        $('#updateAttendanceModal').modal('hide');
        $('#showAttendanceModal').modal('hide');
        

    })
</script>
@endsection