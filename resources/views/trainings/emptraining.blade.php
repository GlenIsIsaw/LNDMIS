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
        

    })
</script>
@endsection