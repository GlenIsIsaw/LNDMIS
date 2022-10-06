@extends('layouts.app')

@section('content')

    <div>
        <livewire:employee-idp-index />
    </div>

        


@endsection

@section('script')
<script>
    window.addEventListener('close-modal', event => {

        $('#createIdpModal').modal('hide');
        $('#create2IdpModal').modal('hide');
        $('#deleteIdpModal').modal('hide');
        $('#showIdpModal').modal('hide');
        $('#updateIdpModal').modal('hide');
        $('#submitIdpModal').modal('hide');
        $('#printIdpModal').modal('hide');
        $('#approveIdpModal').modal('hide');
        $('#rejectIdpModal').modal('hide');
        $('#removeSubmissionIdpModal').modal('hide');
    })
    window.addEventListener('open-create2', event => {


        $('#createIdpModal').modal('hide');
        $('#create2IdpModal').modal('show');
    })
    window.addEventListener('open-show-modal', event => {

        $('#submitIdpModal').modal('hide');
        $('#removeSubmissionIdpModal').modal('hide');
        $('#create2IdpModal').modal('hide');
        $('#update2IdpModal').modal('hide');
        $('#showIdpModal').modal('show');
    })
    window.addEventListener('open-nextUpdate-modal', event => {

        $('#updateIdpModal').modal('hide');
        $('#update2IdpModal').modal('show');
    })


</script>
@endsection