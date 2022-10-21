<div>
    @include('livewire.menu')
    @if ($dashboard)
        @include('dashboard')
    @endif
    @if ($trainingIndex)
        @include('trainings.index')
    @endif

    @if ($idpIndex)
        @include('idp.index')
    @endif

    @if ($userIndex)
        @include('users.index')
    @endif


</div>
