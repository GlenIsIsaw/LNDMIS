<div>
    @include('livewire.menu')
    @if ($trainingIndex)
        @include('trainings.index')
    @endif

    @if ($idpIndex)
        @include('idp.index')
    @endif
    @if (auth()->user()->role_as == 1)
        @if ($userIndex)
            @include('users.index')
        @endif
    @endif

</div>
