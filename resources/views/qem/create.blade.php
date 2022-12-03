<div class="card-header">
    <div class="fw-bolder fs-3 float-start text-uppercase">
        Create Quantified Evaluation Matrix  
    </div>
    <button type="button" class="btn-close mx-2 float-end card-header" data-bs-dismiss="modal" aria-label="Close"
    wire:click="backButton"></button>
</div>
<div class="card-body">
    <div class="mb-1">
        <p>Name: <b>{{$name}} </b></p>
    </div>
    <div class="mb-1">
        <p>Title of Intervension Attended: <b>{{$certificate_title}} </b></p>
    </div>
    @if ($next == 0)
        @include('qem.part.part1')
    @endif
    @if ($next == 1)
        @include('qem.part.part2')
    @endif
    @if ($next == 2)
        @include('qem.part.part3')
    @endif
    @if ($next == 3)
        @include('qem.part.part4')

        <hr class="h-color mx-2 mt-3">
        <div class="float-end">
            <button type="button" wire:click="back" class="btn btn-secondary" id="back" wire:loading.attr="disabled">Back</button>
            <button type="button" class="btn btn-danger" wire:click="backButton">Close</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#createConfirmationQemModal" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save</button>
        </div>
    @endif
</div>