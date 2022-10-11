<div>
    @include('livewire.menu')
    @if ($trainingIndex)
        @include('trainings.index')
    @endif
    @if ($idpIndex)
        @include('idp.index')
    @endif
    
</div>
