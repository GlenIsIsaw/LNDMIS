<div>
    @include('livewire.menu')
    @if ($page == 'dashboard')
        @include('dashboard')
    @endif
    @if ($page == 'training')
        @include('trainings.index')
    @endif

    @if ($page == 'idp')
        @include('idp.index')
    @endif

    @if ($page == 'user')
        @include('users.index')
    @endif

    @if ($page == 'idpSummary')
        @include('idp.summary')
    @endif

    @if ($page == 'attendanceSummary')
        @include('attendanceForm.summary')
    @endif

    @if ($page == 'trainingSummary')
        <div>
            <livewire:training-reports />
        </div>
    @endif
    @if ($page == 'certificateSummary')
    <div>
        <livewire:certificate-reports />
    </div>
@endif

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

            
            $('#deleteIdpModal').modal('hide');
            $('#submitIdpModal').modal('hide');
            $('#printIdpModal').modal('hide');
            $('#approveIdpModal').modal('hide');
            $('#rejectIdpModal').modal('hide');
            $('#removeSubmissionIdpModal').modal('hide');
            $('#createConfirmationIdpModal').modal('hide');
            $('#editConfirmationIdpModal').modal('hide');
            

            $('#userModal').modal('hide');
            $('#updateuserModal').modal('hide');
            $('#deleteuserModal').modal('hide');
            $('#createConfirmationUserModal').modal('hide');
            $('#editConfirmationUserModal').modal('hide');
            $('#changePassUserModal').modal('hide');
            $('#supervisorModal').modal('hide');
            $('#supervisorNotModal').modal('hide');

            $('#printSummaryIdpModal').modal('hide');

            $('#printSummaryAttendanceModal').modal('hide');

            $('#printTrainingModal').modal('hide');
            $('#printCertificateModal').modal('hide');
            
            

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

    @include('livewire.main-modal')
</div>
