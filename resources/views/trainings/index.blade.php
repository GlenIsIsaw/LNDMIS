@extends('layouts.app')

@section('content')

<div>
    <livewire:training-show />
</div>

@endsection


@section('script')
    <script>
        
        window.addEventListener('toggle', event => {
            if(document.getElementById("wrapper").classList.contains('toggled')){

                document.getElementById('main-card').className = 'vw-100';
                document.getElementById('main-card').style.paddingRight = '15%';
            }else{
                document.getElementById('main-card').className = 'w-100';
                document.getElementById('main-card').style.paddingRight = '5%';
            }
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
            $('#createConfirmationTrainingModal').modal('hide');
            $('#editConfirmationTrainingModal').modal('hide');
            $('#createConfirmationAttendanceModal').modal('hide');
            $('#editConfirmationAttendanceModal').modal('hide');


            $('#notificationModal').modal('hide');
            
            
        })
        window.addEventListener('show-notification', event => {

            $('#notificationModal').modal('show');
        })
        window.addEventListener('confirmation-create-training', event => {

            $('#createConfirmationTrainingModal').modal('show');
        })


    </script>

    @endsection

