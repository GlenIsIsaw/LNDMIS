    <div>
        <livewire:idp-show />
    </div>


@section('script')
<script>
    window.addEventListener('close-modal', event => {


        $('#deleteIdpModal').modal('hide');
        $('#submitIdpModal').modal('hide');
        $('#printIdpModal').modal('hide');
        $('#approveIdpModal').modal('hide');
        $('#rejectIdpModal').modal('hide');
        $('#removeSubmissionIdpModal').modal('hide');
    })


</script>
@endsection